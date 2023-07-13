<?php 

namespace App\Model;

use PDO;
use Carbon\Carbon;
use Database\DBconnection;
use App\Enums\CalendarEnum;

#[\AllowDynamicProperties]
abstract class Model{

  protected const ORDER_ASC = 'ASC';
  protected const ORDER_DESC = 'DESC';
  protected $table;
  protected $db;
  protected $dbConnection;
  protected $fillable;
  protected $default;
  protected $statement;
  private $created_at;
  private $updated_at;

  public function __get($property)
  {
    return $this->{$property};
  }
  
  public function __construct(DBconnection $db)
  {
    $this->checkIsSetRequiredProperties();
    $this->created_at = 'created_at';
    $this->updated_at = 'updated_at';
    $this->db = $db;
    $this->dbConnection = $db->getPDO();
  }

  // Check required properties
  protected function checkIsSetRequiredProperties()
  { 
    if(is_null($this->table)) throw new \Exception('table property is null');
    if(is_null($this->fillable)) throw new \Exception('fillable property is null');
  }

  public function all(?string $orderByNameColumn = null, bool $desc = false)
  {
    $sql = "SELECT * FROM {$this->table}";

    if ($orderByNameColumn !== null) {
      $order = $desc ? static::ORDER_DESC : static::ORDER_ASC;
      $sql = $sql . "ORDER BY " . $orderByNameColumn . " " . $order;
    }
    return $this->query($sql);
  }

  public function where(string $column, int|float|bool|string $value, bool $single = false)
  {
    return $this->query("SELECT * FROM {$this->table} WHERE {$column} = :{$column}", [$column => $value], $single);
  }

  public function create(array $data)
  {
    if(!key_exists($this->created_at, $data)) $data[$this->created_at] = Carbon::now();

    $keys = array_keys($data);
    $bindParam = array_map(fn($key) => ':' . $key, $keys);
    return $this->query("INSERT INTO {$this->table} (".implode(',', $keys).") VALUES (".implode(',', $bindParam).")", $data);
  }

  // public function delete(int $id)
  // {
  //   $stmt = $this->dbConnection->prepare($this->createQuery('delete', null, 'id'));
  //   $stmt->bindParam(':id', $id);
  //   $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
  //   return $stmt->execute();
  // }

  public function update(array $data)
  {
    
    $user = $this->where('id', $data['id']);

    if (!empty($user)) {

      $data['updated_at'] = Carbon::now();

      // Prepare update set
      $update_set = "";
      foreach(array_keys($data) as $key => $value ) {
        $update_set = $update_set . $value . " = " . ":$value";

        if (array_key_last(array_keys($data)) != $key) {
          $update_set = $update_set . ", ";
        }
      }

      return $this->query("UPDATE {$this->table} SET {$update_set}  WHERE id = :id", $data);
    }

    return false;
  }

  public function queryBuilder($callback, $bind_value = null)
  {
    $stmt = $this->dbConnection->prepare(call_user_func($callback));
    $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  // Function create & execute the query
  public function query(string $sql, string|array $params = null, bool $single = false): Model|array|bool
  {
    $method = is_null($params) ? 'query' : 'prepare';
    $stmt = $this->dbConnection->$method($sql);
    $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
    if (is_array($params)) {
      foreach($params as $key => $value) $stmt->bindValue(":{$key}", $value);
      $return = $stmt->execute();
    } else if (is_string($params)) {
      $return = $stmt->execute([$params]);
    }

    if ( str_contains($sql, 'INSERT') || str_contains($sql, 'UPDATE') || str_contains($sql, 'DELETE') )
    {
      return $return;
    }
    
    return $single ? $stmt->fetch() : $stmt->fetchAll();
  }

  // Retrieve data with limit
  public function limit(int $start, int $rows)
  {
    return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT {$start}, {$rows}");
  }

  // Retrieve last 10 rows
  public function latest()
  {
    return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT 7");
  }

  // Count new rows last week
  public function lastWeek():int
  {
    return count($this->getGreatOrEqualDate(Carbon::now()->subWeek()));
  }

  // Count new rows last month
  public function lastMonth():int
  {
    return count($this->getGreatOrEqualDate(Carbon::now()->subMonth()));
  }

  // Count all rows
  public function countAll(): int
  {
    return count($this->all());
  }

  // Retrieve data with date range
  private function getGreatOrEqualDate($date): array
  {
    return $this->query("SELECT * FROM {$this->table} WHERE created_at >= ? ", $date);
  }

  // Calculate percent
  public function percent(CalendarEnum $period)
  {
    $lastPeriod = match ($period->name){
      'Week' => 7,
      'Month' => 28,
      'Quarter' => 90,
      'Half' => 180, 
      'Year' =>  365
    };
    
    $rowsPeriod = $this->getGreatOrEqualDate(Carbon::now()->subDays($lastPeriod));
    $rowsTwoPeriod = $this->getGreatOrEqualDate(Carbon::now()->subDays(($lastPeriod * 2)));

    $divider = count($rowsTwoPeriod)  == 0 ? 1 : count($rowsTwoPeriod);
    $percentBeforeLastWeek = (abs((count($rowsTwoPeriod) - count($rowsPeriod))) * 100)  / $divider;
    $percentLastWeek = (count($rowsPeriod) * 100) / $divider;

    return number_format($percentLastWeek - $percentBeforeLastWeek, 2) ;
  }
}
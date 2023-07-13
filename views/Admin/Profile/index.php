<!-- main -->
<main class="content">
  <div class="container-fluid p-0">

    <!-- Button trigger modal -->
    <button id="launch-modal" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
      data-bs-target="#ModalProfileImage">
      Launch modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="ModalProfileImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Image &lbrack;type: png, jpeg, jpg, webp &rbrack;</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="flex-grow-1 h-100" action="/blog/admin/profile/image/save" method="POST" id="change-profile-image" enctype="multipart/form-data">
							<label class="d-block mx-auto" for="profile-image"><span class="visually-hidden">click to add new image</span></label>
							<input type="file" name="image" class="d-none" id="profile-image"/>
							<input type="hidden" name="id" value="<?= $user->id ?>">
							<input type="hidden" name="<?=$csrf['key']?>" value="<?=$csrf['value']?>">
						</form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cleanInput()"
              id="modal-close">Close</button>
            <button type="button" class="btn btn-primary" onclick="sendForm()">Save</button>
          </div>
        </div>
      </div>
    </div>

    <h1 class="h3 mb-3">Profile</h1>

    <div class="row">
      <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="card-title mb-0">Profile Details</h5>
          </div>
          <div class="card-body text-center">
            <div class="position-relative rounded-circle mx-auto mb-3 img-overlay bg-secondary"
              style="width:128px; height: 128px;">
              <img
                src="<?=$config->get('app.url')?>blog/assets/images/avatars/<?= $user->profile_image ?? "default.png" ?>"
                alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
              <div class="overlay d-none">
                <div class="text-white w-100 h-100">
									<!-- click to show form -->
                  <span class="h-100 d-flex justify-content-center align-items-center" id="btn-profile-image">
                    <i class="fa-regular fa-images fs-1"></i>
                    <span class="visually-hidden">click to show form change image</span>
                  </span>
                </div>
              </div>
            </div>

            <h5 class="card-title mb-0"><?=$user->fullName()?></h5>
            <div class="text-muted mb-2">Admin</div>

            <div>
              <a class="btn btn-primary btn-sm" href="#">Follow</a>
              <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
            </div>
          </div>
          <hr class="my-0" />

          <div class="card-body">
            <h5 class="h6 card-title">About</h5>
            <ul class="list-unstyled mb-0">
              <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">San
                  Francisco, SA</a></li>

              <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a
                  href="#">GitHub</a></li>
              <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Boston</a>
              </li>
            </ul>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <h5 class="h6 card-title">Elsewhere</h5>
            <ul class="list-unstyled mb-0">
              <li class="mb-1"><a href="#">staciehall.co</a></li>
              <li class="mb-1"><a href="#">Twitter</a></li>
              <li class="mb-1"><a href="#">Facebook</a></li>
              <li class="mb-1"><a href="#">Instagram</a></li>
              <li class="mb-1"><a href="#">LinkedIn</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-xl-9">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Update Profile Information</h5>
          </div>

          <div class="card-body h-100">
            <!-- profile -->
            <form action="/blog/admin/profile/save" method="POST" id="profile">
              <fieldset>
                <input type="hidden" name="id" value="<?=$user->id?>" required>
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input class="form-control form-control-lg" type="text" name="first_name"
                    value="<?= $request->first_name ?? $user->first_name ?>" required />
                  <small class="d-block invalid-feedback fs-5"></small>
                </div>

                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input class="form-control form-control-lg" type="text" name="last_name"
                    value="<?= $request->last_name ?? $user->last_name?>" required />
                  <small class="d-block invalid-feedback fs-5"></small>
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input class="form-control form-control-lg" type="text" name="phone"
                    value="<?= $request->phone ?? $user->phone?>" required />
                  <small class="d-block invalid-feedback fs-5"></small>
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input class="form-control form-control-lg" type="email" name="email"
                    value="<?= $request->email ?? $user->email?>" required />
                  <small class="d-block invalid-feedback fs-5"></small>
                </div>

                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input class="form-control form-control-lg" type="text" name="username"
                    value="<?= $request->username ?? $user->username?>" required />
                  <small class="d-block invalid-feedback fs-5"></small>
                </div>

                <input type="hidden" name="<?=$csrf['key']?>" value="<?=$csrf['value']?>">

                <div class="text-end mt-3">
                  <button type="submit" class="btn btn-lg btn-primary" onclick="validation(event)">Save</button>
                </div>
              </fieldset>
            </form>
            <!-- end profile -->

          </div>
        </div>
</main>
<!-- End main -->

<!-- script -->
<script>
let initialFormData = {};
const formData = new FormData(document.forms.profile);
formData.forEach((value, key) => initialFormData[key] = value);

function validation(e) {
  // prevent send form
  e.preventDefault();

  let validation = false;

  const form = document.forms.profile;
  const formData = new FormData(form);

  Object.keys(initialFormData).forEach(key => {
    if (!(formData.get(key) === initialFormData[key])) {
      validation = true;
    }
  });

  // If input not change show info message
  if (!validation) {

    Toastify({
      text: 'No Data Changed To Save',
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        fontWeight: 'bold',
        background: "linear-gradient(to right, #FF033E, #FF9900)",
      },
    }).showToast();

    // stop execution and exit from function
    return;
  } //endif

  // reset validation
  validation = true;

  for (let [key, value] of formData) {

    if (key !== 'id' && key !== 'csrf_token') {

      let msg = "";
      let validInput = "";
      setErrorMessage(key, "");

      switch (key) {
        case 'first_name':
          validInput = validator.isAlphanumeric(value.replace(' ', ''));
          msg = !validInput ? "invalid " + key.replace('_', ' ') + " (use only alphanumeric)" : "";
          break;

        case 'last_name':
          validInput = validator.isAlphanumeric(value.replace(' ', ''));
          msg = !validInput ? "invalid " + key.replace('_', ' ') + " (use only alphanumeric)" : "";
          break;

        case 'phone':
          validInput = (validator.isDecimal(value) && value.length == 8);
          msg = !validInput ? "invalid phone number" : "";
          break;

        case 'email':
          validInput = validator.isEmail(value);
          msg = !validInput ? "invalid email address" : "";
          break;

        case 'username':
          validInput = (charOccurrence(value, '_') === 1 && validator.isAlphanumeric(value.replace('_', '')));
          msg = !validInput ? "invalid username (use only alphanumeric and underscore '_')" : "";
          break;

        default:
          break;
      } //endswitch

      if (!validInput) {
        setErrorMessage(key, msg);
        validation = false;
      }
    } //endif
  } //endfor

  if (validation) {
    form.submit();
  }

} //end validation function

function setErrorMessage(element, msg) {
  document.querySelector('input[name=' + element + ']').nextElementSibling.innerHTML = msg;
}

function charOccurrence(string, letter) {
  let count = 0;
  for (let counter = 0; counter < string.length; counter++) {
    if (string.charAt(counter) == letter) {
      count++;
    }
  }

  return count;
}


// Image Profile
const launchModal = document.querySelector('#launch-modal');
const profileImage = document.querySelector('#profile-image');
const modal = document.getElementById('ModalProfileImage');
const form1 = document.forms['change-profile-image'];
let formData1;

// show modal
document.querySelector('#btn-profile-image').addEventListener('click',function() {
	launchModal.click();
});

// profileImage.addEventListener('change', function() {
//   launchModal.click();
//   formData1 = new FormData(form1);
// });

// document.querySelector("button[class='btn-close']").addEventListener('click', () => cleanInput());

// reset modal to default
// modal.addEventListener('click', (e) => {
//   if (e.target.id === 'ModalProfileImage' || e.target.classList.contains('btn-close')) {
//     cleanInput();

//     setTimeout(() => {
//       setModal(modal, null, 'Change Profile Image', 'Click save to change profile image');
//     }, 500);

//   }
// });

// clean input image value
// function cleanInput() {
//   profileImage.value = "";
// }

// send form
function sendForm() {
  const imageType = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp']

  let bodyMSG = "";

  let found = Boolean(imageType.find(type => formData1.get('image').type == type));

  let size = formData1.get('image').size < 500000;

  if (!found) {
    bodyMSG += "<p class='lead mb-1'>Error image type: Choose image with one of this type [png, jpg, jpeg, webp]</p>";
  }

  if (!size) {
    bodyMSG += "<p class='lead mb-1'>Error image size: Choose image with size less then 500kb</p>";
  }

  if (!(found && size)) {

    setModal(modal, 'error', 'Error', bodyMSG, false);

    setTimeout(function() {
      launchModal.click();
    }, 500);
  }

  if (found && size) {
    form1.submit();
  }

  // Close modal
  document.querySelector('#modal-close').click();

} //end sendForm function

// Set modal info
function setModal(modal, type, title, body, enableFooter = true) {

  const modalTitle = modal.querySelector('.modal-title');
  type === 'error' ? modalTitle.classList.add('text-danger') : modalTitle.classList.remove('text-danger');
  modalTitle.innerHTML = title;
  modal.querySelector('.modal-body').innerHTML = body;
  enableFooter ? modal.querySelector('.modal-footer').classList.remove('d-none') : modal.querySelector('.modal-footer')
    .classList.add('d-none');
}
</script>
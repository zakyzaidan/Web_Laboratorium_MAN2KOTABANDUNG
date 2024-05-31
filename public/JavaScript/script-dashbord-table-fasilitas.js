$(document).ready(function() {

    $('#myTable').DataTable({
        pageLength: 5, // Menampilkan 50 entri per halaman secara default
        lengthMenu: false // Menyembunyikan menu entri per halaman
    });
});

    // Add Bootstrap JavaScript (assuming you're using it)
// Make sure to include Bootstrap's CSS as well

const tambahForm = document.getElementById('tambahForm');
const jumlahInput = document.getElementById('jumlah');
const kondisiBaikInput = document.getElementById('kondisiBaik');
const kondisiBurukInput = document.getElementById('kondisiBuruk');

// Initially disable Kondisi Baik and Kondisi Buruk fields
kondisiBaikInput.disabled = true;
kondisiBurukInput.disabled = true;

kondisiBaikInput.value = jumlahInput.value || 0;
kondisiBurukInput.value = 0;
jumlahValue = parseInt(jumlahInput.value) || 0;
kondisiBaikValue = parseInt(kondisiBaikInput.value) || 0;
kondisiBurukValue = parseInt(kondisiBurukInput.value) || 0;

// Function to update field enable/disable states
function updateFieldStates() {

  if (jumlahValue === 0) {
    kondisiBaikValue = parseInt(kondisiBaikInput.value) || 0;
    console.log(kondisiBaikInput.value);
    if(kondisiBaikValue === 0){
        kondisiBaikInput.disabled = true;
        kondisiBurukInput.disabled = true;
    }else{
        kondisiBaikInput.disabled = false;
        kondisiBurukInput.disabled = false;
    }
  } else {
    kondisiBaikInput.disabled = false;
    kondisiBurukInput.disabled = false;

    // Check if Kondisi Baik + Kondisi Buruk exceeds Jumlah
    if (kondisiBaikValue + kondisiBurukValue > jumlahValue && kondisiBaikValue + kondisiBurukValue < jumlahValue) {
      kondisiBaikInput.setCustomValidity('Jumlah Baik + Kondisi Buruk tidak boleh melebihi Jumlah');
      kondisiBurukInput.setCustomValidity('Jumlah Baik + Kondisi Buruk tidak boleh melebihi Jumlah');
    } else {
      kondisiBaikInput.setCustomValidity('');
      kondisiBurukInput.setCustomValidity('');
    }
  }

  if(parseInt(jumlahInput.value) < 0){
    jumlahInput.value = 0;
  }

  if (kondisiBaikInput.value === '') {
    jumlahValue = parseInt(jumlahInput.value) || 0;
    kondisiBaikValue = parseInt(kondisiBaikInput.value) || 0;
    kondisiBurukValue = parseInt(kondisiBurukInput.value) || 0;
    kondisiBaikInput.value = jumlahValue;
    kondisiBurukInput.value = 0;
  }else if (jumlahValue === parseInt(jumlahInput.value)) {
    console.log(kondisiBaikValue);
    console.log(parseInt(kondisiBaikInput.value));
    if(kondisiBaikValue === parseInt(kondisiBaikInput.value)){
        console.log("test3");
        kondisiBurukValue = parseInt(kondisiBurukInput.value) || 0;
        if(kondisiBurukValue < 0){
            kondisiBurukInput.value = 0;
            kondisiBaikInput.value = jumlahValue;
        }else if(kondisiBurukValue > jumlahValue){
            kondisiBurukInput.value = jumlahValue;
            kondisiBaikInput.value = 0;
        }else{
            kondisiBaikInput.value = jumlahValue - kondisiBurukValue;
        }

    }else{
        kondisiBaikValue = parseInt(kondisiBaikInput.value) || 0;
        if(kondisiBaikValue < 0){
            kondisiBaikInput.value = 0;
            kondisiBurukInput.value = jumlahValue;
        }else if(kondisiBaikValue > jumlahValue){
            kondisiBaikInput.value = jumlahValue;
            kondisiBurukInput.value = 0;
        }else{
            kondisiBurukInput.value = jumlahValue - kondisiBaikValue;
        }
    }
    console.log("test1");
  }else{
    jumlahValue = parseInt(jumlahInput.value) || 0;
    kondisiBaikInput.value = jumlahValue;
    kondisiBaikValue = parseInt(kondisiBaikInput.value) || 0;

    console.log("test2");
  }


}

// Update field states on initial load
updateFieldStates();

// Update field states on Jumlah input change
jumlahInput.addEventListener('input', updateFieldStates);

// Update field states on Kondisi Baik input change
kondisiBaikInput.addEventListener('input', updateFieldStates);

// Update field states on Kondisi Buruk input change
kondisiBurukInput.addEventListener('input', updateFieldStates);

// Reset form on modal show
$('#tambahModal').on('show.bs.modal', function () {
  jumlahInput.value = '';
  kondisiBaikInput.value = '';
  kondisiBurukInput.value = '';
  updateFieldStates();
});


function previewImage() {
    var preview = document.querySelector("#image-preview");
    var file = document.querySelector("#image-upload").files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('image/image-default.png') }}";
    }
}

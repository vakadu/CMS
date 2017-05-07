//For editor
tinymce.init({ selector:'textarea' });

//For Checkboxes
$(document).ready(function () {
   $('#selectAllBoxes').click(function (event) {
       if (this.checked){
           $('.checkBoxes').each(function () {
              this.checked = true;
           });
       }
       else {
           $('.checkBoxes').each(function () {
               this.checked = false;
           });
       }
   });
});

//For preloader
var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$('body').prepend(div_box);
$('#load-screen').delay(1000).fadeOut(600, function () {
   $(this).remove();
});

// File choose in admin add_post starts
var fileInputTextDiv = document.getElementById('file_input_text_div');
var fileInput = document.getElementById('file_input_file');
var fileInputText = document.getElementById('file_input_text');

fileInput.addEventListener('change', changeInputText);
fileInput.addEventListener('change', changeState);

function changeInputText() {
    var str = fileInput.value;
    var i;
    if (str.lastIndexOf('\\')) {
        i = str.lastIndexOf('\\') + 1;
    } else if (str.lastIndexOf('/')) {
        i = str.lastIndexOf('/') + 1;
    }
    fileInputText.value = str.slice(i, str.length);
}

function changeState() {
    if (fileInputText.value.length != 0) {
        if (!fileInputTextDiv.classList.contains("is-focused")) {
            fileInputTextDiv.classList.add('is-focused');
        }
    } else {
        if (fileInputTextDiv.classList.contains("is-focused")) {
            fileInputTextDiv.classList.remove('is-focused');
        }
    }
}
// File choose in admin add_post ends
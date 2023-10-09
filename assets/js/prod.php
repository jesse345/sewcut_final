<script>
// document.getElementById('fileInput').addEventListener('change', function (event) {
//     const files = event.target.files;
//     const imagePreviews = document.querySelector('.imagePreviews');
//     const errorContainer = document.querySelector('.error-container');
//     const submitButton = document.querySelector('#add_product_btn');

//   imagePreviews.innerHTML = '';
//   errorContainer.innerHTML = '';

//     if (files.length > 5){
//         submitButton.disabled = true;
//         const errorText = document.createElement('p');
//         errorText.textContent = 'Please upload between 4 and 5 images.';
//         errorContainer.appendChild(errorText);

        
//     } else {
//         for (let i = 0; i < files.length; i++) {
//             const file = files[i];

//             if (file) {
//                 const reader = new FileReader();

//                 reader.onload = function (e) {
//                     const img = document.createElement('img');
//                     img.src = e.target.result;
//                     img.alt = 'Image Preview';
//                     img.className = 'img-responsive';
//                     imagePreviews.appendChild(img);
//                 };

//                 reader.readAsDataURL(file);
//             }
//         }
//         submitButton.disabled = false;
//     }
// });
    const formContainer = $("#level-container");
    formContainer.on("click", ".add", function () {
        const newRow = $("<div>").addClass("row").html(`
            <div class="col-sm-3 col-lg-3">
                <label>Color <span style="color:red">*</span></label>
                <select class="form-control" name="color[]" required>
                    <option value="" selected>Select Color</option>
                    <?php include("fetchColor.php"); ?>
                </select>
            </div>
            <div class="col-sm-3 col-lg-3">
                <label>Size <span style="color:red">*</span></label>
                <select class="form-control" name="size[]" required>
                    <option value="" selected>Select Color</option>
                    <?php include("fetchSize.php"); ?>
                </select>
            </div>
            <div class="col-sm-3 col-lg-2">
                <label>Price <span style="color:red">*</span></label>
                <input type="text" style="text-align: center" class="form-control" name="price[]" required>
            </div>
            <div class="col-sm-3 col-lg-2">
                <label>Stock <span style="color:red">*</span></label>
                <input type="text" style="text-align: center" class="form-control" name="stock[]" required>
            </div>

            <div class="col-sm-3 col-lg-2" style="position: relative;top: 33px;left: 57px;">
                <button type="button" class="add" style="background-color: transparent;border: none;"> 
                    <i class="fa fa-plus-circle" style="font-size: 31px; color: green;"></i>
                </button>
                <button type=button class="remove" style="background-color: transparent;border: none;">
                    <i class="fa fa-trash"  style="font-size: 31px; color: red;"></i>
                </button>
            </div>
        `);
        formContainer.append(newRow);
    });

    formContainer.on("click", ".remove", function () {
        const row = $(this).closest(".row");
        if (row.length > 0) {
            row.remove();
        }
    });

     function previewBeforeUpload(id) {
        document.querySelector("#" + id).addEventListener("change", function (e) {
            if (e.target.files.length == 0) {
                return;
            }
            const imagePreviews = document.querySelector('.imagePreviews');
            const errorContainer = document.querySelector('.error-container');
            const submitButton = document.querySelector('#add_product_btn');
            const files = event.target.files;

            imagePreviews.innerHTML = '';
            errorContainer.innerHTML = '';

            if (files.length > 5){
                submitButton.disabled = true;
                const errorText = document.createElement('p');
                errorText.textContent = 'Please upload between 4 and 5 images.';
                errorContainer.appendChild(errorText);

                
            } else {
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let url = URL.createObjectURL(file);

                    let previewElement = document.createElement("div");
                    previewElement.classList.add("preview-item");

                    if (file.type.startsWith("image/")) {
                        // If it's an image file, display it using an <img> element
                        previewElement.innerHTML = `<img src="${url}" alt="${file.name}" />`;
                    } else if (file.type.startsWith("video/")) {
                        // If it's a video file, display it using a <video> element
                        previewElement.innerHTML = `<video width="320" height="295" controls><source src="${url}" type="${file.type}">Your browser does not support the video tag.</video>`;
                    } else {
                        // Handle other file types here (if needed)
                        previewElement.innerText = file.name;
                    }
                    
                    document.querySelector(".imagePreviews").appendChild(previewElement);
                }
            }
        });
    }

    function previewBeforeUploadUpload(id) {
        document.querySelector("#" + id).addEventListener("change", function (e) {
            if (e.target.files.length == 0) {
                return;
            }
            const imagePreviews = document.querySelector('.imagePreviews123');
            const errorContainer = document.querySelector('.error-container123');
            const submitButton = document.querySelector('#UPDATE');
            const files = event.target.files;

            imagePreviews.innerHTML = '';
            errorContainer.innerHTML = '';

            
          
            if (files.length > 5){
                submitButton.disabled = true;
                const errorText = document.createElement('p');
                errorText.textContent = 'Please upload between 4 and 5 images.';
                errorContainer.appendChild(errorText);

                
            } else {
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let url = URL.createObjectURL(file);

                    let previewElement = document.createElement("div");
                    previewElement.classList.add("preview-item");

                    if (file.type.startsWith("image/")) {
                        // If it's an image file, display it using an <img> element
                        previewElement.innerHTML = `<img src="${url}" alt="${file.name}" />`;
                    } else if (file.type.startsWith("video/")) {
                        // If it's a video file, display it using a <video> element
                        previewElement.innerHTML = `<video width="320" height="295" controls><source src="${url}" type="${file.type}">Your browser does not support the video tag.</video>`;
                    } else {
                        // Handle other file types here (if needed)
                        previewElement.innerText = file.name;
                    }
                    
                    document.querySelector(".imagePreviews123").appendChild(previewElement);
                }
            }
        });
    }
    previewBeforeUploadUpload("fileInput123");



    previewBeforeUpload("fileInput");


//   previewBeforeUpload("file-1");
//   previewBeforeUpload("file-2");
//   previewBeforeUpload("file-3");
//   previewBeforeUpload("file-4");
//   previewBeforeUpload("file-5");

</script>
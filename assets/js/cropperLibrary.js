// build it with 💗 by copilot X Ir.Teguh

class CropperLibrary {
    constructor() {
        this.img = null;
        this.result = null;
        this.img_result = null;
        this.img_w = null;
        this.img_h = null;
        this.options = null;
        this.crop = null;
        this.save = null;
        this.cropped = null;
        this.dwn = null;
        this.upload = null;
        this.cropper = null;
        this.croppedImage = null; // Declared globally within the class
		this.reset = null;
		
	}
	setupCropper() {
		if (!this.img) {
			console.error("No image available to crop.");
			return;
		}

		// Ensure the image element is in the DOM before initializing the Cropper
		if (!document.body.contains(this.img)) {
			console.error("Image element is not in the DOM.");
			return;
		}

		// Ensure the result element exists before initializing the Cropper
		if (!this.result) {
			console.error("Result element not found.");
			return;
		}

		// Destroy existing Cropper instance if it exists
		if (this.cropper) {
			this.cropper.destroy();
			this.cropper = null;
		}

		// Initialize the Cropper instance
		this.cropper = new Cropper(this.img, {
			viewMode: 1, // Ensure the crop box stays within the image boundaries
			autoCrop: true, // Automatically display the crop box
			aspectRatio: 2.07, // Set the aspect ratio
			crop: () => {
				const cropBoxData = this.cropper.getCropBoxData(); // Get current crop box dimensions
				const imageData = this.cropper.getImageData(); // Get original image dimensions (natural size)

				// Calculate scaling factors
				const scaleX = imageData.naturalWidth / imageData.width;
				const scaleY = imageData.naturalHeight / imageData.height;

				// Convert crop box dimensions to original resolution
				const originalWidth = Math.round(cropBoxData.width * scaleX);
				const originalHeight = Math.round(cropBoxData.height * scaleY);

				// Update the input fields with the original dimensions if valid
				if (originalWidth > 0 && originalHeight > 0) {
					this.img_w.value = originalWidth; // Update width
					this.img_h.value = originalHeight; // Update height
				} else {
					console.error("Failed to retrieve valid crop box dimensions.");
				}

				this.reset.classList.remove('hide'); // Show the "Reset" button
			},
		});

		this.options.classList.remove('hide'); // Show cropping options
		this.save.classList.remove('hide'); // Show "Save" button
	}


	initializeHandlers() {
		// Initialize DOM elements
		this.result = document.querySelector('.result');
		this.img_result = document.querySelector('.img-result');
		this.img_w = document.querySelector('.img-w');
		this.img_h = document.querySelector('.img-h');
		this.options = document.querySelector('.options');
		this.crop = document.querySelector('.crop');
		this.save = document.querySelector('.save');
		this.cropped = document.querySelector('.cropped');
		this.dwn = document.querySelector('.download');
		this.upload = document.querySelector('#file-input');
		this.reset = document.querySelector('.reset');

		 // Check if an image is already present in the result container
		this.img = document.querySelector('#image');
		if (this.img) {
			this.setupCropper(); // Initialize cropper with the existing image
		}

		// Handle file upload and preview the image
		this.upload.addEventListener('change', (e) => {
			if (e.target.files.length) {
				const reader = new FileReader();
				reader.onload = (e) => {
					if (e.target.result) {
						this.img = document.createElement('img');
						this.img.id = 'image';
						this.img.src = e.target.result;

						this.img.onload = () => {
							if (this.result) { // Ensure the result element exists
								this.result.innerHTML = ''; // Clear previous image
								this.result.appendChild(this.img); // Append the new image
								this.crop.classList.remove('hide'); // Show "Crop" button
							} else {
								console.error("Result element not found.");
							}
							this.setupCropper(); // Call the Cropper setup function
						};
					}
				};
				reader.readAsDataURL(e.target.files[0]);
			}
		});

		// Handle "Crop" button click
		this.crop.addEventListener('click', (e) => {
			e.preventDefault();
			if (this.img && document.body.contains(this.img)) {
				this.setupCropper(); // Call the Cropper setup function
			} else {
				console.error("Image element is not in the DOM.");
			}
		});

		// Handle width and height input changes to resize the crop box
		this.img_w.addEventListener('input', () => {
			if (this.cropper) {
				const width = parseInt(this.img_w.value);
				const height = parseInt(this.img_h.value);

				if (!isNaN(width) && !isNaN(height) && width > 0 && height > 0) {
					this.cropper.setCropBoxData({
						width,
						height
					});
				} else {
					console.error("Invalid width or height inputs.");
				}
			}
		});

		this.img_h.addEventListener('input', () => {
			if (this.cropper) {
				const width = parseInt(this.img_w.value);
				const height = parseInt(this.img_h.value);

				if (!isNaN(width) && !isNaN(height) && width > 0 && height > 0) {
					this.cropper.setCropBoxData({
						width,
						height
					});
				} else {
					console.error("Invalid width or height inputs.");
				}
			}
		});

		// Handle "Save" button click to crop the image
		this.save.addEventListener('click', (e) => {
			e.preventDefault();
			if (this.cropper) {
				try {
					const width = parseInt(this.img_w.value);
					const height = parseInt(this.img_h.value);

					// Validate width and height inputs
					if (!width || !height || isNaN(width) || isNaN(height)) {
						console.error("Invalid width or height inputs");
						alert("Please enter valid width and height.");
						return;
					}

					// Get the cropped canvas
					const canvas = this.cropper.getCroppedCanvas({
						width,
						height
					});

					if (!canvas) {
						console.error("Failed to create canvas");
						alert("Unable to crop the image. Please try again.");
						return;
					}

					// Convert the canvas to an image data URL
					const imgSrc = canvas.toDataURL();
					this.cropped.classList.remove('hide');
					this.img_result.classList.remove('hide');
					this.cropped.src = imgSrc; // Display cropped image
					this.dwn.classList.remove('hide');
					this.dwn.download = 'cropped-image.png'; // Set download link
					this.dwn.setAttribute('href', imgSrc);
					this.croppedImage = imgSrc; // Store cropped image
				} catch (error) {
					console.error("Error cropping the image:", error);
				}
			}
		});

		// Handle "Reset" button click
		this.reset.addEventListener('click', (e) => {
			e.preventDefault();
			this.resetCropper(); // Call the resetCropper function
		});

		
	}
	getCroppedImage() {
		if (this.croppedImage) {
			console.log("Returning cropped image:", this.croppedImage); // Log the cropped image
			return this.croppedImage;
		} else {
			console.error("No cropped image available.");
			return null;
		}
	}
    
    resetCropper() {
        // Destroy existing Cropper instance if it exists
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }

        // Clear the result container and inputs
        this.result.innerHTML = ''; // Remove the image from the DOM
        this.img = null; // Reset the image variable
        this.img_w.value = ''; // Clear the width input
        this.img_h.value = ''; // Clear the height input

        // Hide options and buttons
        this.options.classList.add('hide'); // Hide the cropping options
        this.save.classList.add('hide'); // Hide the "Save" button
        this.crop.classList.add('hide'); // Hide the "Crop" button
        this.cropped.classList.add('hide'); // Hide the cropped image
        this.img_result.classList.add('hide'); // Hide the result container
        this.dwn.classList.add('hide'); // Hide the download button

        // Reset the global croppedImage variable
        this.croppedImage = null;
        this.reset.classList.add('hide'); // Hide the "Reset" button

        console.log("Cropper has been reset.");
    }

	
	

    base64ToBlob(base64, mime) {
        var byteString = atob(base64.split(',')[1]);
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: mime });
    }
}

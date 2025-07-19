<x-layout>
  <h2>Capture and Save Image</h2>

    <!-- Camera Preview -->
    <video id="camera" autoplay></video>
    <canvas id="canvas" style="display: none;"></canvas>
    
    <!-- Capture Button -->
    <button id="capture">Capture</button>
    
    <!-- Preview of Captured Image -->
    <img id="preview" style="display:none;" />

    <!-- Form to Send Image -->
    <form id="uploadForm" method="POST" action="{{ route('upload.image') }}">
        @csrf
        <input type="hidden" name="image" id="imageData">
        <button type="submit">Upload Image</button>
    </form>

    <script>
        const video = document.getElementById('camera');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');
        const preview = document.getElementById('preview');
        const imageDataInput = document.getElementById('imageData');
        const uploadForm = document.getElementById('uploadForm');

        // Access Camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.error("Camera access error:", error);
            });

        // Capture Image
        captureButton.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Convert Image to Base64
            const imageData = canvas.toDataURL('image/png');
            preview.src = imageData;
            preview.style.display = "block";

            // Save image data to input field
            imageDataInput.value = imageData;
        });

        // Handle Form Submission
        uploadForm.addEventListener('submit', function(event) {
            if (!imageDataInput.value) {
                event.preventDefault();
                alert("Capture an image first!");
            }
        });
    </script>
</x-layout>
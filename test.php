<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Access and QR Code Scanner</title>
    <style>
        #video {
            width: 100%;
            max-width: 600px;
            margin: auto;
            display: block;
        }

        #captureButton {
            display: block;
            margin: 20px auto;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        #result {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Camera Access and QR Code Scanner</h1>

    <!-- Video feed from the camera -->
    <video id="video" autoplay></video>

    <!-- Capture button with camera icon -->
    <button id="captureButton" onclick="capturePhoto()">
        📷 Scan QR Code
    </button>

    <!-- Result area to display scanned QR Code content -->
    <div id="result"></div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        // Get the video element and set up camera access
        const video = document.getElementById('video');
        const resultDiv = document.getElementById('result');
        let scanner;

        // Initialize the Instascan scanner
        function initScanner() {
            scanner = new Instascan.Scanner({ video: video });

            // Add a listener for the 'scan' event
            scanner.addListener('scan', function (content) {
                // Handle the scanned QR code content
                resultDiv.innerText = 'Scanned content: ' + content;
            });

            // Start scanning
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]); // Use the first available camera
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        }

        // Function to capture photo from the video feed
        function capturePhoto() {
            // Create a canvas element to draw the captured photo
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Set the canvas dimensions to match the video feed
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the current video frame onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert the canvas content to a data URL (base64 encoded image)
            const photoDataUrl = canvas.toDataURL('image/png');

            // Display the captured photo (you can also send it to the server, etc.)
            showCapturedPhoto(photoDataUrl);
        }

        // Function to display the captured photo (in this example, just an alert)
        function showCapturedPhoto(photoDataUrl) {
            alert('Photo captured!\nData URL: ' + photoDataUrl);
        }

        // Initialize the scanner when the page is loaded
        window.onload = initScanner;
    </script>

</body>
</html>

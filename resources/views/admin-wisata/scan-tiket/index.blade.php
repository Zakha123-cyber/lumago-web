@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        {{-- Header Section --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Scan QR Tiket</h2>
                <p class="mt-1 text-lg text-gray-400">Verifikasi tiket pengunjung dengan scan QR code</p>
            </div>
            <a href="{{ route('admin-wisata.dashboard.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 transition-colors rounded-lg hover:text-white hover:bg-white/10">
                <i class="mr-2 fa-solid fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- Alert/Notification --}}
        @if (session('error'))
            <div class="p-4 border rounded-lg bg-red-500/20 border-red-500/30">
                <div class="flex items-center gap-2 text-red-400">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <div class="grid gap-8 lg:grid-cols-2">
            {{-- Camera Scanner --}}
            <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="mr-2 fa-solid fa-camera"></i>
                        Scan dengan Kamera
                    </h3>
                </div>
                <div id="reader" class="w-full rounded-lg bg-black/50 aspect-video"></div>
                <div class="flex flex-wrap gap-3 mt-6">
                    <button id="startScan" type="button"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-green-500 text-white font-medium hover:bg-green-600 transition-colors">
                        <i class="mr-2 fa-solid fa-qrcode"></i> Mulai Scan
                    </button>
                    <button id="capturePhoto" type="button"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-blue-500 text-white font-medium hover:bg-blue-600 transition-colors hidden">
                        <i class="mr-2 fa-solid fa-camera"></i> Ambil Foto
                    </button>
                    <button id="stopScan" type="button"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-gray-600 text-white font-medium hover:bg-gray-700 transition-colors hidden">
                        <i class="mr-2 fa-solid fa-stop"></i> Stop Scan
                    </button>
                </div>
                {{-- Preview Captured Image --}}
                <div id="capturePreview" class="hidden mt-4">
                    <canvas id="canvas" class="w-full rounded-lg"></canvas>
                    <div class="flex gap-3 mt-4">
                        <button id="retakePhoto" type="button"
                            class="flex-1 px-4 py-2.5 rounded-lg bg-gray-600 text-white font-medium hover:bg-gray-700 transition-colors">
                            <i class="mr-2 fa-solid fa-redo"></i> Ambil Ulang
                        </button>
                        <button id="processCapture" type="button"
                            class="flex-1 px-4 py-2.5 rounded-lg bg-green-500 text-white font-medium hover:bg-green-600 transition-colors">
                            <i class="mr-2 fa-solid fa-check"></i> Proses QR
                        </button>
                    </div>
                </div>
            </div>

            {{-- Image Upload --}}
            <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="mr-2 fa-solid fa-upload"></i>
                        Upload QR Code
                    </h3>
                </div>
                <form id="uploadForm" method="POST" action="{{ route('admin-wisata.scan.import') }}"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div
                        class="p-8 transition-colors border-2 border-gray-600 border-dashed rounded-lg hover:border-green-500/50">
                        <input type="file" name="qr_image" accept="image/*" required
                            class="block w-full text-sm text-gray-400 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-500 file:text-white hover:file:bg-green-600" />
                        <p class="mt-2 text-sm text-gray-500">PNG, JPG atau WEBP (Max. 2MB)</p>
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-2.5 rounded-lg bg-blue-500 text-white font-medium hover:bg-blue-600 transition-colors">
                        <i class="mr-2 fa-solid fa-upload"></i> Upload & Scan QR
                    </button>
                </form>
            </div>
        </div>

        {{-- Instructions Card --}}
        <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
            <h3 class="mb-4 text-lg font-semibold text-white">
                <i class="mr-2 fa-solid fa-circle-info"></i>
                Petunjuk Penggunaan
            </h3>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <p class="font-medium text-gray-300">Scan dengan Kamera:</p>
                    <ol class="ml-4 space-y-1 text-sm text-gray-400 list-decimal">
                        <li>Klik tombol "Mulai Scan"</li>
                        <li>Izinkan akses kamera jika diminta</li>
                        <li>Arahkan kamera ke QR code tiket</li>
                        <li>QR code akan otomatis terdeteksi</li>
                    </ol>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-gray-300">Upload QR Code:</p>
                    <ol class="ml-4 space-y-1 text-sm text-gray-400 list-decimal">
                        <li>Pilih file gambar QR code</li>
                        <li>Klik tombol "Upload & Scan QR"</li>
                        <li>Tunggu proses scanning selesai</li>
                        <li>Hasil scan akan ditampilkan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            let html5Qr;
            let isScanning = false;
            let currentStream;

            document.getElementById('startScan').onclick = function() {
                if (isScanning) return;
                isScanning = true;

                document.getElementById('startScan').classList.add('hidden');
                document.getElementById('capturePhoto').classList.remove('hidden');
                document.getElementById('stopScan').classList.remove('hidden');
                document.getElementById('capturePreview').classList.add('hidden');

                html5Qr = new Html5Qrcode("reader");
                Html5Qrcode.getCameras().then(cameras => {
                    if (cameras && cameras.length) {
                        html5Qr.start(
                            cameras[0].id, {
                                fps: 10,
                                qrbox: {
                                    width: 250,
                                    height: 250
                                }
                            },
                            qrCodeMessage => {
                                stopScanning();
                                window.location.href = "{{ url('admin-wisata/scan/show') }}/" +
                                    encodeURIComponent(qrCodeMessage);
                            },
                            errorMessage => {
                                // ignore scan errors
                            }
                        ).catch(err => {
                            console.error("Error starting scanner:", err);
                        });

                        // Store video stream reference
                        setTimeout(() => {
                            const video = document.querySelector('#reader video');
                            if (video) {
                                currentStream = video.srcObject;
                            }
                        }, 1000);
                    } else {
                        alert('Kamera tidak ditemukan');
                        stopScanning();
                    }
                }).catch(err => {
                    alert('Tidak dapat mengakses kamera: ' + err);
                    stopScanning();
                });
            };

            document.getElementById('capturePhoto').onclick = function() {
                const video = document.querySelector('#reader video');
                if (!video) {
                    alert('Video belum siap');
                    return;
                }

                // Create canvas if not exists
                let canvas = document.getElementById('canvas');
                if (!canvas) {
                    canvas = document.createElement('canvas');
                    canvas.id = 'canvas';
                    canvas.classList.add('w-full', 'rounded-lg');
                    document.getElementById('capturePreview').appendChild(canvas);
                }

                const context = canvas.getContext('2d');

                // Set canvas dimensions to match video
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                // Draw current video frame
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Pause video stream
                if (html5Qr) {
                    html5Qr.pause(true);
                }

                // Show capture preview
                document.getElementById('capturePreview').classList.remove('hidden');
                document.getElementById('capturePhoto').classList.add('hidden');
            };

            document.getElementById('retakePhoto').onclick = function() {
                if (html5Qr) {
                    html5Qr.resume();
                }
                document.getElementById('capturePreview').classList.add('hidden');
                document.getElementById('capturePhoto').classList.remove('hidden');
            };

            document.getElementById('processCapture').onclick = function() {
                const canvas = document.getElementById('canvas');
                if (!canvas) return;

                const imageData = canvas.toDataURL('image/jpeg', 0.9);

                // Create form data
                const formData = new FormData();
                formData.append('qr_image', dataURItoBlob(imageData));

                // Add CSRF token to headers
                const headers = new Headers({
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                });

                // Send to server
                fetch('{{ route('admin-wisata.scan.import') }}', {
                        method: 'POST',
                        body: formData,
                        headers: headers
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = data.redirect;
                        } else {
                            alert(data.error || 'QR Code tidak terdeteksi');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses gambar');
                    });
            };

            function dataURItoBlob(dataURI) {
                const byteString = atob(dataURI.split(',')[1]);
                const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                const ab = new ArrayBuffer(byteString.length);
                const ia = new Uint8Array(ab);

                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ab], {
                    type: mimeString
                });
            }

            function stopScanning() {
                if (html5Qr && isScanning) {
                    html5Qr.stop().then(() => {
                        isScanning = false;
                        document.getElementById('startScan').classList.remove('hidden');
                        document.getElementById('capturePhoto').classList.add('hidden');
                        document.getElementById('stopScan').classList.add('hidden');
                        document.getElementById('capturePreview').classList.add('hidden');
                    });
                }
            }

            document.getElementById('stopScan').onclick = stopScanning;
        </script>
    @endpush
@endsection

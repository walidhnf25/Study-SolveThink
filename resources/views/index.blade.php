<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Kelas Bimbel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <div class="card bg-white" style="max-width: 700px;">
        <div class="form-header">
            <div class="form-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div class="form-title">Pendaftaran Kelas Bimbingan Belajar</div>
            <div class="form-subtitle">Isi formulir di bawah untuk mendaftar kelas</div>
        </div>

        <form id="pendaftaranForm">
            <div class="input-group">
                <span class="input-icon"><i class="bi bi-person-fill"></i></span>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap Individu/Perwakilan" required>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-whatsapp"></i></span>
                <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Nomor WhatsApp Individu/Perwakilan" required>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control" name="asalSekolah" id="asalSekolah" placeholder="Asal Sekolah/Universitas" required>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-people-fill"></i></span>
                <select class="form-select" name="tipePendaftaran" id="tipePendaftaran" required>
                    <option value="" disabled selected>Tipe Pendaftaran</option>
                    <option value="Individu">Individu</option>
                    <option value="Group">Group</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-person-plus-fill"></i></span>
                <select class="form-select" name="jumlahPeserta" id="jumlahPeserta" required>
                    <option value="" disabled selected>Jumlah Peserta</option>
                    <option value="1 orang">1 orang</option>
                    <option value="3-5 orang">3-5 orang</option>
                    <option value="5-10 orang">5-10 orang</option>
                    <option value="10-20 orang">10-20 orang</option>
                    <option value="20+ orang">20+ orang</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-book-fill"></i></span>
                <select class="form-select" name="topikPembelajaran" id="topikPembelajaran" required>
                    <option value="" disabled selected>Topik Pembelajaran</option>
                    <option value="Software Development">Software Development</option>
                    <option value="ML AI Data Science">ML AI Data Science</option>
                    <option value="Internet of Things">Internet of Things</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="bi bi-journal-text"></i></span>
                <input type="text" class="form-control" name="ideJudul" id="ideJudul" placeholder="Ide Judul Pembelajaran (Kosongkan jika belum ada)">
            </div>

            <div class="input-group clickable-input-group" onclick="document.getElementById('tanggal').showPicker()">
                <span class="input-icon"><i class="bi bi-calendar-date-fill"></i></span>
                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
            </div>

            <div class="input-group clickable-input-group" onclick="document.getElementById('waktu').showPicker()">
                <span class="input-icon"><i class="bi bi-clock-fill"></i></span>
                <input type="time" class="form-control" name="waktu" id="waktu" required>
            </div>

            <div class="input-group file-upload-container">
                <span class="input-icon"><i class="bi bi-card-image"></i></span>
                <div class="custom-file-upload">
                    <input type="file" class="form-control" id="idCardUpload" name="idCardUpload" accept="image/jpeg,image/png,image/jpg,application/pdf" required hidden>
                    <label for="idCardUpload" class="file-upload-btn">
                        <i class="bi bi-upload me-2"></i>
                        <span class="file-text">Pilih File</span>
                    </label>
                    <div id="filePreview" class="file-preview-container"></div>
                    <div class="selected-file" id="selectedFileName">Belum ada file dipilih</div>
                    <div class="form-text mt-1">Upload bukti kartu pelajar/KTM/KTP (individu/Perwakilan)</div>
                </div>
            </div>

            <!-- Modal Konfirmasi Sebelum Kirim -->
            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="confirmSubmitModalLabel"><i class="fas fa-question-circle me-2"></i>Konfirmasi Pendaftaran</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-0">Apakah Anda yakin ingin menyelesaikan pendaftaran ini?</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="confirmSubmitBtn">Ya, Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi WhatsApp -->
            <div class="modal fade" id="pesananModal" tabindex="-1" aria-labelledby="pesananModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="pesananModalLabel"><i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Pendaftaran</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body text-start p-4">
                            <p class="mb-3"><i class="bi bi-check2-all me-2 text-success"></i>Terimakasih telah melakukan pendaftaran, Harap konfirmasi pendaftaran anda ke WhatsApp Admin agar dapat diproses.</p>
                            <p><i class="bi bi-clipboard-check me-2 text-primary"></i><strong>Format Konfirmasi:</strong></p>
                            <div class="ps-4">
                                <p><i class="bi bi-chat-text me-2 text-secondary"></i>halo kak, saya telah melakukan pemesanan, mohon segera di proses!<br>
                                <i class="bi bi-person me-2 text-secondary"></i>Nama: (Isikan nama anda)<br>
                                <i class="bi bi-building me-2 text-secondary"></i>Asal Sekolah/Universitas: (Isikan Asal Sekolah Anda)<br>
                                <i class="bi bi-people me-2 text-secondary"></i>Jumlah Peserta: (Isikan Jumlah Peserta)<br>
                                <i class="bi bi-book me-2 text-secondary"></i>Topik Pembelajaran: (Isikan ide judul pembelajaran/kosongkan jika belum ada)</p>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" id="backToOrderBtn" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali ke Form
                            </button>
                            <a id="whatsappLink" href="#" target="_blank" class="btn btn-success">
                                <i class="bi bi-whatsapp me-2"></i>Konfirmasi Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-submit">
                <i class="bi bi-send-fill me-2"></i>Kirim Pendaftaran
            </button>
        </form>

        <div class="form-footer">
            Dengan mengirimkan formulir ini, Anda setuju dengan persyaratan dan ketentuan kami.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview handling
        const fileInput = document.getElementById('idCardUpload');
        const fileLabel = document.querySelector('.file-upload-btn');
        const fileText = document.querySelector('.file-text');
        const selectedFileName = document.getElementById('selectedFileName');
        const filePreview = document.getElementById('filePreview');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Update the file name display
                    selectedFileName.textContent = file.name;
                    fileLabel.classList.add('has-file');
                    fileText.textContent = 'File Dipilih';

                    // Show preview for image files
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            filePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                            filePreview.style.display = 'flex';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // For non-image files
                        filePreview.innerHTML = '<div class="text-center p-3"><i class="bi bi-file-earmark-text fs-1"></i><p>File siap diupload</p></div>';
                        filePreview.style.display = 'flex';
                    }
                } else {
                    // Reset if no file selected
                    selectedFileName.textContent = 'Belum ada file dipilih';
                    fileLabel.classList.remove('has-file');
                    fileText.textContent = 'Pilih File';
                    filePreview.style.display = 'none';
                    filePreview.innerHTML = '';
                }
            });
        }

        // Form submission and modal handling
        const pendaftaranForm = document.getElementById('pendaftaranForm');
        const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
        let formData = {};

        // Form submit button click handler
        document.querySelector('.btn-submit').addEventListener('click', function(event) {
            event.preventDefault();

            // Get all required form values
            const nama = document.getElementById('nama').value;
            const whatsapp = document.getElementById('whatsapp').value;
            const asalSekolah = document.getElementById('asalSekolah').value;
            const tipePendaftaran = document.getElementById('tipePendaftaran').value;
            const jumlahPeserta = document.getElementById('jumlahPeserta').value;
            const topikPembelajaran = document.getElementById('topikPembelajaran').value;
            const ideJudul = document.getElementById('ideJudul').value;
            const tanggal = document.getElementById('tanggal').value;
            const waktu = document.getElementById('waktu').value;
            const idCardFile = document.getElementById('idCardUpload').files[0];

            // Form validation - check required fields
            if (!nama || !whatsapp || !asalSekolah || !tipePendaftaran || !jumlahPeserta ||
                !topikPembelajaran || !tanggal || !waktu || !idCardFile) {
                alert("Harap lengkapi semua data yang diperlukan sebelum mengirim!");
                return;
            }

            // Save form data for WhatsApp message
            formData = {
                nama,
                whatsapp,
                asalSekolah,
                tipePendaftaran,
                jumlahPeserta,
                topikPembelajaran,
                ideJudul,
                tanggal,
                waktu
            };

            // Show confirmation modal
            const modal = new bootstrap.Modal(document.getElementById('confirmSubmitModal'));
            modal.show();
        });

        // Confirmation button click handler
        if (confirmSubmitBtn) {
            confirmSubmitBtn.addEventListener('click', function() {
                // Hide confirmation modal
                bootstrap.Modal.getInstance(document.getElementById('confirmSubmitModal')).hide();

                // Create WhatsApp message from form data
                const { nama, asalSekolah, whatsapp, tipePendaftaran, jumlahPeserta, topikPembelajaran, ideJudul, tanggal, waktu } = formData;

                // Format tanggal to be more readable
                const formattedDate = new Date(tanggal).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                let message = `Halo Admin, saya ingin konfirmasi pendaftaran kelas.\n\n` +
                            `Nama: ${nama}\n` +
                            `WhatsApp: ${whatsapp}\n` +
                            `Asal Sekolah/Universitas: ${asalSekolah}\n` +
                            `Tipe Pendaftaran: ${tipePendaftaran}\n` +
                            `Jumlah Peserta: ${jumlahPeserta}\n` +
                            `Topik Pembelajaran: ${topikPembelajaran}\n` +
                            `Ide Judul: ${ideJudul || 'Belum ada'}\n` +
                            `Tanggal: ${formattedDate}\n` +
                            `Waktu: ${waktu}`;

                // Set WhatsApp link with message
                const whatsappURL = `https://wa.me/6281293768288?text=${encodeURIComponent(message)}`;
                document.getElementById('whatsappLink').href = whatsappURL;

                // Show WhatsApp confirmation modal
                const pesananModal = new bootstrap.Modal(document.getElementById('pesananModal'));
                pesananModal.show();
            });
        }

        // WhatsApp modal close button
        document.querySelector('#pesananModal .btn-close').addEventListener('click', function() {
            setTimeout(() => {
                location.reload();
            }, 300);
        });

        // Back to form button
        document.getElementById('backToOrderBtn').addEventListener('click', function() {
            location.reload();
        });

        // WhatsApp link click
        document.getElementById('whatsappLink').addEventListener('click', function() {
            bootstrap.Modal.getInstance(document.getElementById('pesananModal')).hide();
        });
    });
    </script>
    </body>
</html>
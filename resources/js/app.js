import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Delete functionality module
const DeleteManager = {
    /**
     * Initialize delete functionality
     */
    init() {
        this.initHospitalDelete();
        this.initPatientDelete();
    },

    /**
     * Initialize hospital delete functionality
     */
    initHospitalDelete() {
        document.querySelectorAll('.delete-hospital').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const hospitalId = button.getAttribute('data-id');
                const hospitalName = button.getAttribute('data-name');
                
                this.showDeleteConfirmation(
                    'Konfirmasi Hapus',
                    `Apakah anda yakin ingin menghapus hospital "${hospitalName}"?`
                ).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteHospital(hospitalId, button);
                    }
                });
            });
        });
    },

    /**
     * Initialize patient delete functionality
     */
    initPatientDelete() {
        document.querySelectorAll('.delete-patient').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const patientId = button.getAttribute('data-id');
                const patientName = button.getAttribute('data-name');
                
                this.showDeleteConfirmation(
                    'Konfirmasi Hapus',
                    `Apakah anda yakin ingin menghapus patient "${patientName}"?`
                ).then((result) => {
                    if (result.isConfirmed) {
                        this.deletePatient(patientId, button);
                    }
                });
            });
        });
    },

    /**
     * Show delete confirmation dialog
     */
    showDeleteConfirmation(title, text) {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded');
            return Promise.resolve({ isConfirmed: false });
        }
        
        return Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });
    },

    /**
     * Show loading dialog
     */
    showLoadingDialog(title, text) {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded');
            return;
        }
        
        Swal.fire({
            title: title,
            text: text,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    },

    /**
     * Show success dialog
     */
    showSuccessDialog(title, text) {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded');
            return Promise.resolve();
        }
        
        return Swal.fire({
            title: title,
            text: text,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    },

    /**
     * Show error dialog
     */
    showErrorDialog(title, text) {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded');
            return;
        }
        
        Swal.fire({
            title: title,
            text: text,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    },

    /**
     * Remove table row and handle empty state
     */
    removeTableRow(button, emptyMessage, colspan = 6) {
        const row = button.closest('tr');
        row.remove();
        
        const tbody = document.querySelector('tbody');
        if (tbody.children.length === 0) {
            tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center text-muted">${emptyMessage}</td></tr>`;
        }
    },

    /**
     * Send AJAX delete request
     */
    sendDeleteRequest(url, successMessage, errorMessage, button, emptyMessage, colspan = 6) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => {
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            if (data.success) {
                this.showSuccessDialog('Berhasil!', successMessage).then(() => {
                    this.removeTableRow(button, emptyMessage, colspan);
                });
            } else {
                this.showErrorDialog('Error!', data.message || errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.showErrorDialog('Error!', errorMessage);
        });
    },

    /**
     * Delete hospital
     */
    deleteHospital(hospitalId, button) {
        this.showLoadingDialog('Menghapus...', 'Sedang menghapus hospital');
        
        this.sendDeleteRequest(
            `/hospitals/${hospitalId}`,
            'Hospital berhasil dihapus',
            'Terjadi kesalahan saat menghapus hospital',
            button,
            'Tidak ada data hospital',
            6
        );
    },

    /**
     * Delete patient
     */
    deletePatient(patientId, button) {
        this.showLoadingDialog('Menghapus...', 'Sedang menghapus patient');
        
        this.sendDeleteRequest(
            `/patients/${patientId}`,
            'Patient berhasil dihapus',
            'Terjadi kesalahan saat menghapus patient',
            button,
            'Tidak ada data patient',
            6
        );
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing DeleteManager...');
    console.log('SweetAlert2 available:', typeof Swal !== 'undefined');
    console.log('Delete buttons found:', document.querySelectorAll('.delete-hospital, .delete-patient').length);
    
    DeleteManager.init();
    
    console.log('DeleteManager initialized successfully');
});

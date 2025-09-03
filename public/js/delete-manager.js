// Delete Manager - Simple JavaScript without Vite
document.addEventListener('DOMContentLoaded', function() {
    console.log('Delete Manager loaded');
    
    // Check if SweetAlert2 is available
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 not loaded');
        return;
    }
    
    console.log('SweetAlert2 is available');
    
    // Initialize delete functionality
    initDeleteFunctionality();
    
    function initDeleteFunctionality() {
        // Hospital delete buttons
        document.querySelectorAll('.delete-hospital').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const hospitalId = this.getAttribute('data-id');
                const hospitalName = this.getAttribute('data-name');
                
                showDeleteConfirmation(
                    'Konfirmasi Hapus',
                    `Apakah anda yakin ingin menghapus hospital "${hospitalName}"?`
                ).then((result) => {
                    if (result.isConfirmed) {
                        deleteHospital(hospitalId, this);
                    }
                });
            });
        });
        
        // Patient delete buttons
        document.querySelectorAll('.delete-patient').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const patientId = this.getAttribute('data-id');
                const patientName = this.getAttribute('data-name');
                
                showDeleteConfirmation(
                    'Konfirmasi Hapus',
                    `Apakah anda yakin ingin menghapus patient "${patientName}"?`
                ).then((result) => {
                    if (result.isConfirmed) {
                        deletePatient(patientId, this);
                    }
                });
            });
        });
        
        console.log('Delete functionality initialized');
    }
    
    function showDeleteConfirmation(title, text) {
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
    }
    
    function showLoadingDialog(title, text) {
        Swal.fire({
            title: title,
            text: text,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }
    
    function showSuccessDialog(title, text) {
        return Swal.fire({
            title: title,
            text: text,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
    
    function showErrorDialog(title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
    
    function removeTableRow(button, emptyMessage, colspan = 6) {
        const row = button.closest('tr');
        row.remove();
        
        const tbody = document.querySelector('tbody');
        if (tbody.children.length === 0) {
            tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center text-muted">${emptyMessage}</td></tr>`;
        }
    }
    
    function sendDeleteRequest(url, successMessage, errorMessage, button, emptyMessage, colspan = 6) {
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
                showSuccessDialog('Berhasil!', successMessage).then(() => {
                    removeTableRow(button, emptyMessage, colspan);
                });
            } else {
                showErrorDialog('Error!', data.message || errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorDialog('Error!', errorMessage);
        });
    }
    
    function deleteHospital(hospitalId, button) {
        showLoadingDialog('Menghapus...', 'Sedang menghapus hospital');
        
        sendDeleteRequest(
            `/hospitals/${hospitalId}`,
            'Hospital berhasil dihapus',
            'Terjadi kesalahan saat menghapus hospital',
            button,
            'Tidak ada data hospital',
            6
        );
    }
    
    function deletePatient(patientId, button) {
        showLoadingDialog('Menghapus...', 'Sedang menghapus patient');
        
        sendDeleteRequest(
            `/patients/${patientId}`,
            'Patient berhasil dihapus',
            'Terjadi kesalahan saat menghapus patient',
            button,
            'Tidak ada data patient',
            6
        );
    }
});

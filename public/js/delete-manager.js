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
    
    // Initialize filter functionality
    initFilterFunctionality();
    
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
    
    function initFilterFunctionality() {
        const hospitalFilter = document.getElementById('hospital-filter');
        const clearFilterBtn = document.getElementById('clear-filter');
        
        if (hospitalFilter) {
            hospitalFilter.addEventListener('change', function() {
                const hospitalId = this.value;
                filterPatients(hospitalId);
            });
        }
        
        if (clearFilterBtn) {
            clearFilterBtn.addEventListener('click', function() {
                hospitalFilter.value = '';
                filterPatients('');
            });
        }
        
        console.log('Filter functionality initialized');
    }
    
    function filterPatients(hospitalId) {
        console.log('Filtering patients for hospital ID:', hospitalId);
        
        // Show loading state
        const tableBody = document.getElementById('patient-table-body');
        if (tableBody) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
        }
        
        // Prepare URL
        let url = '/patients/index';
        if (hospitalId) {
            url += '?hospital_id=' + hospitalId;
        }
        
        console.log('Requesting URL:', url);
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const token = csrfToken ? csrfToken.getAttribute('content') : '';
        
        // Send AJAX request
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            if (data.success) {
                // Update table body with new data
                if (tableBody) {
                    tableBody.innerHTML = data.html;
                }
                
                // Re-initialize delete functionality for new rows
                initDeleteFunctionality();
                
                console.log('Filter applied successfully');
            } else {
                throw new Error('Filter request failed');
            }
        })
        .catch(error => {
            console.error('Filter error:', error);
            
            // Show error message
            if (tableBody) {
                tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading data. Please try again.</td></tr>';
            }
            
            // Show error alert
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memfilter data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
});

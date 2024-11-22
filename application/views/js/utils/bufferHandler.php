<script>
    if (typeof showLoading !== 'function') {
        function showLoading(pesan = "Sedang memproses data") {
            Swal.fire({
                text: pesan,
                customClass: 'swal-wide'
            })
            Swal.showLoading()
        }
    }
    
    if (typeof hideLoading !== 'function') {
        function hideLoading() {
            Swal.close()
        }
    }
</script>
<script>
if (config.sanitize.numberOnly) {
    $(".number-only").each(function() {
        $(this).on("paste keyup blur", function(e) {
            $(this).val(this.value.replace(/[^\d]/g, ''))
        })
    })

    function numberOnly(value) {
        return value.replace(/[^\d]/g, '')
    }
}

// currency handler (rupiah)
if (config.sanitize.rupiah) {
    $('.rupiah').each((i, el) => {
        el.addEventListener("keyup", function(e) {
            this.value = formatRupiah(this.value, "Rp. ")
        })

        el.addEventListener("blur", function(e) {
            this.value = formatRupiah(this.value, "Rp. ")
        })
    })

    function formatRupiah(angka, prefix, limit = config.sanitize.rupiahLimit ?? 0) {
        let resultNumber = addingDot(angka)

        if (limit != 0 && parseInt(resultNumber.replace(/\./g, '')) > limit) {
            resultNumber = addingDot(limit.toString())
        }

        return prefix == undefined ? resultNumber : resultNumber ? prefix + resultNumber : ""
    }


    function addingDot(angka) {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi)

        if (ribuan) {
            separator = sisa ? "." : ""
            rupiah += separator + ribuan.join(".")
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah

        return rupiah
    }
}
</script>
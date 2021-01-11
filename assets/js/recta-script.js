const rupiah = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: null,
});

const rupiah2 = new Intl.NumberFormat(['ban', 'id']);


// modal view penjualan
$('.handleView').on('click', function () {

    $('input[type="text"],texatrea', this).val('');
    // $('#pengirim').val('').html('');
    // $('#penerima').val('').html('');
    // $('#tujuan').val('').html('');
    // $('#airlines').val('').html('');
    // $('#no_penerbangan').val('').html('');
    // $('#no_smu').val('').html('');
    // $('#berat').val('').html('');
    // $('#koli').val('').html('');
    // // hidden
    // $('#jenis_pembayaran').val('');

    const id = $(this).data('id');
    const tujuanID = $(this).data('tujuan');

    $.ajax({
        url: base_url + "penjualan/print-nota",
        data: {
            id: id,
            tujuanID: tujuanID
        },
        method: 'post',
        dataType: 'json',
        success: function (data) {

            const { no_kwitansi, pengirim, penerima, airlines, no_penerbangan, no_smu, berat, koli, isi, catatan, biaya_smu, total_operasional, total_biaya_gudang, biaya_tambahan, biaya_total } = data.data_penjualan;

            // hidden
            const biayaPengiriman = parseInt(biaya_smu) + parseInt(total_operasional);
            const jasaGudang = total_biaya_gudang;
            const total = biaya_total;
            const { jenis_pembayaran, created_at } = data.data_penjualan;

            $('#no_kwitansi').val(no_kwitansi);
            $('#pengirim').val(pengirim);
            $('#penerima').val(penerima);
            $('#tujuan').val(data.kota_tujuan);
            $('#airlines').val(airlines);
            $('#no_penerbangan').val(no_penerbangan);
            $('#no_smu').val(no_smu);
            $('#berat').val(berat);
            $('#koli').val(koli);
            $('#isi').val(isi);
            $('#catatan').val(catatan);
            $('#biaya_smu').val(rupiah.format(biaya_smu));
            $('#total_handling').val(rupiah.format(total_operasional));
            $('#biaya_gudang').val(rupiah.format(total_biaya_gudang));
            $('#biaya_tambahan').val(rupiah.format(biaya_tambahan));
            $('#total').val(rupiah.format(biaya_total));
            // hidden
            $('#jenis_pembayaran').val(jenis_pembayaran);
            $('#tanggal').val(created_at);

            // print
            $('#btnPrint').one('click', function () {
                handlePrint(biaya_tambahan, biayaPengiriman, jasaGudang, total);
            })
        }
    });
});


// RECTA 
function handlePrint(biaya_tambahan, biayaPengiriman, jasaGudang, total) {

    const printer = new Recta('3889156889', '1811')

    const kasir = $('#kasir').val()
    const rawTanggal = $('#tanggal').val()
    const tanggal = moment(rawTanggal).format('MM-DD-YYYY');
    const pengirim = $('#pengirim').val()
    const penerima = $('#penerima').val()
    const tujuan = $('#tujuan').val()
    const airlines = $('#airlines').val()
    const noSMU = $('#no_smu').val()
    const berat = $('#berat').val()
    const koli = $('#koli').val()
    const jenisPembayaran = $('#jenis_pembayaran').val()


    printer.open().then(function () {
        printer.font('A')
            .align('CENTER')
            .bold(true)
            .text('CV.KALBAR KARGO MANDIRI')
            .bold(false)
            .font('B')
            .text('Jl. Arteri Supadio')
            .text('Komplek Adi Griya Karya No. K-17')
            .text('Kalimantan Barat')
            .text('Telp/Hp. 085787578464')
            .text('Email : kalbarkargomandiri@gmail.com')
            /** */
            .text('------------------------------------------')
            .align('LEFT')
            .text(`Kasir \t: ${kasir}`)
            .text(`Tanggal \t: ${tanggal}`)
            .align('center')
            .text('------------------------------------------')
            /** */
            .align('LEFT')
            .text(`Pengirim \t ${pengirim.toUpperCase()}`)
            .text(`Penerima \t ${penerima.toUpperCase()}`)
            .text(`Airlines \t ${airlines.toUpperCase()}`)
            .text(`Rute \t Pontianak-${tujuan}`)
            .text(`No.SMU \t ${noSMU}`)
            .text(`Berat \t ${berat} Kg`)
            .text(`Koli \t ${koli}`)
            .text(`By.Pengiriman \t Rp. ${rupiah2.format(biayaPengiriman)}`)
            .text(`Jasa Gudang \t Rp. ${rupiah2.format(jasaGudang)}`)
            .text(`Biaya Tambahan \t Rp. ${rupiah2.format(biaya_tambahan)}`)
            .text(`Jenis Pembayaran \t ${jenisPembayaran.toUpperCase()}`)
            /** */
            .text('------------------------------------------')
            .align('RIGHT').text(`Total   Rp. ${rupiah2.format(total)}`)
            .text('------------------------------------------')
            /** */
            // .underline(true)
            // .text('This is underline text')
            // .underline(false)
            .align('CENTER')
            .text('Terima Kasih')
            .cut()
            .print()
    })
}
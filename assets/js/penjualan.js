$(document).ready(function () {
  const rupiah = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });



  /**
   * ketika memilih kota
   * Pilih harga official / Custom
   */
  $("#kota").on("change", function () {
    $("#custom2").val("").html("");
    $("#custom1").prop("checked", true);
    $("#customHarga").addClass('d-none');

    const id = $(this).children("option:selected").val();
    if (id !== '') {
      $("#tipe").removeClass('d-none');
      customHarga(id)
    } else {
      $("#tipe").addClass('d-none');
      $("#labelOfficialHarga").html('');
    }
  });

  function customHarga(id) {
    $.ajax({
      url: base_url + "penjualan/getHarga",
      data: {
        id: id,
      },
      method: "POST",
      dataType: "JSON",
      success: function (data) {
        $('#labelOfficialHarga').html(`Harga Official (${rupiah.format(data.biaya)})`);

        $("#custom1").on("click", function () {
          $("#cusHarga").val("");
          $("#customHarga").addClass('d-none');
        });
        $("#custom2").on("click", function () {
          $("#customHarga").removeClass('d-none');
        });
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(`Status: ${textStatus}, Error: ${errorThrown}`);
      },
    });
  }



  /**
   * Tombol Cek TOtal Harga
   */
  $("#cekHarga").click(function () {
    // $(this).prop("disabled", true);
    $("#result").html("");

    let tujuan = $("#kota").val();
    let cusHarga = $("#cusHarga").val();
    let berat = $("#berat").val();
    let hargaGudang = $("#bGudang").val();
    let adminSMU = $("#adminSMU").val();
    let biayaOperasional = $("#biaya_operasional").val();
    let adminGudang = $("#adminGudang").val();
    let biayaTambahan = $("#biayaTambahan").val();

    const data = {
      tujuan: tujuan,
      custom_harga: cusHarga,
      berat: berat,
      biaya_gudang: hargaGudang,
      admin_smu: adminSMU,
      biaya_operasional: biayaOperasional,
      admin_gudang: adminGudang,
      biaya_tambahan: (biayaTambahan == "") ? 0 : biayaTambahan, // cek apakah ada biaya tambahan atau tidak
    }

    $.ajax({
      url: base_url + "penjualan/cekHarga",
      data: data,
      method: "POST",
      dataType: "JSON",
      success: function (data) {
        //
        // console.log(data);
        $("#result").append(
          `
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Total Harga</label>
                <div class="col-sm-12 col-md-10">
                <span class="text-danger">*</span><small>Simpan untuk melanjutkan, refresh halaman ini jika melakukan perubahan data.</small><br/>
                <small>(` + rupiah.format(data.biaya) + ` x ` + data.berat + `) + ` + rupiah.format(data.adminSMU) + ` = ` + rupiah.format(data.biayaSMU) + `</small><br/>
                <small>(` + rupiah.format(data.hargaGudang) + ` x ` + data.berat + `) + ` + rupiah.format(data.adminGudang) + ` = ` + rupiah.format(data.biayaGudang) + `</small><br/>
                <small>`+ rupiah.format(data.biayaOperasional) + ` X ` + data.berat + ` = ` + rupiah.format(data.totalOperasional) + `</small><br>
                <small>` + rupiah.format(data.biayaSMU) + ` + ` + rupiah.format(data.biayaGudang) + ` + ` + rupiah.format(data.biayaTambahan) + ` + ` + rupiah.format(data.totalOperasional) + ` = ` + rupiah.format(data.biayaTotal) + `</small><h5 class="font-weight-bold harga">` + rupiah.format(data.biayaTotal) +
          `</h5>
                </div>
            </div>
        `
        );
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Terjadi kesalahan harap periksa kembali data!");
      },
    });
  });



  // Biaya tambahan
  $(document).on("click", ".form-check-tambah", function () {
    if ($("input.check").prop("checked", true)) {
      $(".biayaTambahan").attr("readonly", false);
    }
  });
  $(document).on("dblclick", ".form-check-tambah", function () {
    if (this.checked) {
      $(this).prop("checked", false);
      $(".biayaTambahan").attr("readonly", true);
      $(".biayaTambahan").val("").html("");
    }
  });



  /**
   * ketika pengirim diklik
   * if langganan tampil deposit
   * if hutang no deposit
   */
  $("#pengirim").on("change", function () {
    $("#namaPengirim").html("");
    const id = $(this).children("option:selected").val();

    if (id == 0) {
      $("#namaPengirim").append(`
          <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">Nama Pengirim<span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-10">
                  <input class="form-control" name="pengirim_baru" placeholder="Nama pengirim baru .." type="text" value="" required>
              </div>
          </div>
      `);
      $("#depo").hide();
    } else {
      // $("#namaPengirim").html("");
      $.ajax({
        url: base_url + "penjualan/cekTipePengirim",
        data: {
          id: id,
        },
        method: "POST",
        dataType: "JSON",
        success: function (data) {
          // console.log(data);
          if (data.tipe == 1) {
            $(".deposit").html("Hutang");
          } else {
            $(".deposit").html("Deposit");
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert(errorThrown);
        },
      });

      $("#depo").show();
    }

    //
  });

  //
});

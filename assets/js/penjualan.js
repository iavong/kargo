$(document).ready(function () {
  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });

  /**
   * ketika memilih kota
   * Pilih harga official / Custom
   */
  $("#kota").on("change", function () {
    $("#tipe").val("").html("");
    $("#custom2").val("").html("");
    $("#customHarga").val("").html("");

    const id = $(this).children("option:selected").val();
    // console.log(id);

    $.ajax({
      url: base_url + "penjualan/getHarga",
      data: {
        id: id,
      },
      method: "POST",
      dataType: "JSON",
      success: function (data) {
        // console.log(id);
        $("#tipe").append(
          `<div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label"></label>
                <div class="col-sm-12 col-md-10">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom1" name="tipe" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="custom1">Harga Official (` +
          formatter.format(data.biaya) +
          `)</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom2" name="tipe" class="custom-control-input" required>
                        <label class="custom-control-label" for="custom2">Custom Harga</label>
                    </div>
                </div>
            </div>`
        );

        $("#custom1").on("click", function () {
          $("#customHarga").val("").html("");
        });
        //
        $("#custom2").on("click", function () {
          $("#customHarga").val("").html("");

          //   var kota = $(this).children("option:selected").val();
          //   console.log("ok");
          $("#customHarga").append(`
              <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">Custom Harga<span class="text-danger">*</span></label>
                  <div class="col-sm-12 col-md-10">
                      <input class="form-control int" name="custom_harga" placeholder="Custom harga .." type="text" value="" id="cusHarga" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                  </div>
              </div>
          `);
          //
        });
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });

    //
  });

  //

  /**
   * Tombol Cek TOtal Harga
   */
  $("#cekHarga").click(function () {
    // $(this).prop("disabled", true);
    $("#result").html("");

    var tujuan = $("#kota").val();
    var cusHarga = $("#cusHarga").val();
    var berat = $("#berat").val();
    var hargaGudang = $("#bGudang").val();
    var adminSMU = $("#adminSMU").val();
    var biayaOperasional = $("#biaya_operasional").val();
    var adminGudang = $("#adminGudang").val();
    var biayaTambahan = $("#biayaTambahan").val();

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
                <small>(` + formatter.format(data.biaya) + ` x ` + data.berat + `) + ` + formatter.format(data.adminSMU) + ` = ` + formatter.format(data.biayaSMU) + `</small><br/>
                <small>(` + formatter.format(data.hargaGudang) + ` x ` + data.berat + `) + ` + formatter.format(data.adminGudang) + ` = ` + formatter.format(data.biayaGudang) + `</small><br/>
                <small>`+ formatter.format(data.biayaOperasional) + ` X ` + data.berat + ` = ` + formatter.format(data.totalOperasional) + `</small><br>
                <small>` + formatter.format(data.biayaSMU) + ` + ` + formatter.format(data.biayaGudang) + ` + ` + formatter.format(data.biayaTambahan) + ` + ` + formatter.format(data.totalOperasional) + ` = ` + formatter.format(data.biayaTotal) + `</small><h5 class="font-weight-bold harga">` + formatter.format(data.biayaTotal) +
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

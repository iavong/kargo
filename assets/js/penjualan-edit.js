$(document).ready(function () {
  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });

  /**
   * KOTA
   * fungsi onload
   */
  const idUser = $(".id-user").val();

  $.ajax({
    url: base_url + "penjualan/cekCustomHarga",
    data: {
      idUser: idUser,
    },
    method: "POST",
    dataType: "JSON",
    success: function (data) {
      // var customHarga = true;
      var customHarga = data.custom_harga;
      var biayaTambahan = data.biaya_tambahan;

      //biaya tambahan
      if (biayaTambahan != "") {
        if ($("input.check").prop("checked", true)) {
          $(".biayaTambahanEdit").attr("readonly", false);
        }
      } else {
        if (this.checked) {
          $(this).prop("checked", false);
          $(".biayaTambahanEdit").attr("readonly", true);
          $(".biayaTambahanEdit").val("").html("");
        }
      }

      // custom harga
      if (customHarga == "") {
        getOfficialHarga(customHarga);
      } else {
        getCustomHarga(customHarga);
      }
      //
    },
  });

  // jika merubah kota
  if ($("#kota-edit").on("change")) {
    getKotaChanged();
  }

  /**
   * fungsi edit dengan custom harga
   * @param customHarga = data.custom_harga
   */
  function getCustomHarga(customHarga) {
    const id = $("#kota-edit").val();

    $.ajax({
      url: base_url + "penjualan/getHarga",
      data: {
        id: id,
      },
      method: "POST",
      dataType: "JSON",
      success: function (data) {
        // tampilkan pilihan harga
        $("#tipe-edit").append(
          `<div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label"></label>
                <div class="col-sm-12 col-md-10">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom1-edit" name="tipe" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="custom1-edit">Harga Official (` +
          formatter.format(data.biaya) +
          `)</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom2-edit" name="tipe" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="custom2-edit">Custom Harga</label>
                    </div>
                </div>
            </div>`
        );

        // tampilkan custom harga
        tampilFormCustomHarga(customHarga);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  }

  /**
   * jika tidak custom harga
   * @param customHarga = null
   */
  function getOfficialHarga(customHarga) {
    const id = $("#kota-edit").val();

    //
    $.ajax({
      url: base_url + "penjualan/getHarga",
      data: {
        id: id,
      },
      method: "POST",
      dataType: "JSON",
      success: function (data) {
        // tampilkan pilihan harga
        $("#tipe-edit").append(
          `<div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label"></label>
                <div class="col-sm-12 col-md-10">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom1-edit" name="tipe" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="custom1-edit">Harga Official (` +
          formatter.format(data.biaya) +
          `)</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom2-edit" name="tipe" class="custom-control-input" required>
                        <label class="custom-control-label" for="custom2-edit">Custom Harga</label>
                    </div>
                </div>
            </div>`
        );

        // tampilkan custom harga
        tampilFormCustomHarga(customHarga);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  }

  /**
   * fungsi ketika kota diubah
   */
  function getKotaChanged(customHarga) {
    $("#kota-edit").on("change", function () {
      $("#tipe-edit").val("").html("");
      $("#custom2-edit").val("").html("");
      $("#customHarga-edit").val("").html("");

      const id = $(this).children("option:selected").val();
      // const id = $("#kota-edit").val();
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
          $("#tipe-edit").append(
            `<div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label"></label>
                <div class="col-sm-12 col-md-10">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom1-edit" name="tipe" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="custom1-edit">Harga Official (` +
            formatter.format(data.biaya) +
            `)</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom2-edit" name="tipe" class="custom-control-input" required>
                        <label class="custom-control-label" for="custom2-edit">Custom Harga</label>
                    </div>
                </div>
            </div>`
          );

          // form custom harga
          tampilFormCustomHarga(customHarga);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert("Harap lengkapi data terlebih dahulu!");
        },
      });
    });
  }

  // form custom harga
  function tampilFormCustomHarga(customHarga = "") {
    // var harga = customHarga;

    $("#custom1-edit").on("click", function () {
      $("#customHarga-edit").val("").html("");
    });
    //
    $("#custom2-edit").on("click", function () {
      if ($("#custom2-edit").is(":checked")) {
        // alert("it's checked");
        $("#customHarga-edit").val("").html("");

        $("#customHarga-edit").append(
          `
          <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">Custom Harga<span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-10">
                  <input class="form-control int" name="custom_harga" placeholder="Custom harga .." type="text" value="` +
          (customHarga == "" ? "" : customHarga) +
          `" id="cusHarga" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
              </div>
          </div>
      `
        );
      }
      //
    });

    if ($("#custom2-edit").is(":checked")) {
      // alert("it's checked");
      $("#customHarga-edit").val("").html("");

      $("#customHarga-edit").append(
        `
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Custom Harga<span class="text-danger">*</span></label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control int" name="custom_harga" placeholder="Custom harga .." type="text" value="` +
        (customHarga == "" ? "" : customHarga) +
        `" id="cusHarga"  oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
            </div>
        </div>
    `
      );
    }
  }

  /**
   * Tombol Cek TOtal Harga
   */
  $("#cekHargaEdit").click(function () {
    // $(this).prop("disabled", true);
    $("#result").html("");

    var tujuan = $("#kota-edit").val();
    var cusHarga = $("#cusHarga").val();
    var berat = $("#berat").val();
    var hargaGudang = $("#bGudang").val();
    var adminSMU = $("#adminSMU").val();
    var biayaOperasional = $("#biaya_operasional_edit").val();
    var adminGudang = $("#adminGudang").val();
    var biayaTambahanEdit = $("#biayaTambahanEdit").val();

    const data = {
      tujuan: tujuan,
      custom_harga: cusHarga,
      berat: berat,
      biaya_gudang: hargaGudang,
      admin_smu: adminSMU,
      biaya_operasional: biayaOperasional,
      admin_gudang: adminGudang,
      biaya_tambahan: (biayaTambahanEdit == "") ? 0 : biayaTambahanEdit, // cek apakah ada biaya tambahan atau tidak
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
                <small>`+ formatter.format(data.biayaOperasional) + ` x ` + data.berat + ` = ` + formatter.format(data.totalOperasional) + `</small><br>
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

  $(document).on("click", ".form-check-edit", function () {
    if ($("input.check").prop("checked", true)) {
      $(".biayaTambahanEdit").attr("readonly", false);
    }
  });

  $(document).on("dblclick", ".form-check-edit", function () {
    if (this.checked) {
      $(this).prop("checked", false);
      $(".biayaTambahanEdit").attr("readonly", true);
      $(".biayaTambahanEdit").val("").html("");
    }
  });

  //
});

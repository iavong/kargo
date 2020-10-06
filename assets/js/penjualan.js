$(document).ready(function () {
  // ketika memilih kota
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
            data.biaya +
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
                          <input class="form-control" name="custom_harga" placeholder="Custom harga .." type="text" value="" id="cusHarga">
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

  // Cek Total Harga
  $("#cekHarga").click(function () {
    // $(this).prop("disabled", true);
    $("#result").html("");

    var tujuan = $("#kota").val();
    var cusHarga = $("#cusHarga").val();
    var berat = $("#berat").val();
    var hargaGudang = $("#bGudang").val();
    var adminSMU = $("#adminSMU").val();
    var adminGudang = $("#adminGudang").val();
    var biayaTambahan = $("#biayaTambahan").val();

    if (biayaTambahan === "") {
      $.ajax({
        url: base_url + "penjualan/cekHarga",
        data: {
          tujuan: tujuan,
          custom_harga: cusHarga,
          berat: berat,
          biaya_gudang: hargaGudang,
          admin_smu: adminSMU,
          admin_gudang: adminGudang,
          biaya_tambahan: 0,
        },
        method: "POST",
        dataType: "JSON",
        success: function (data) {
          //
          console.log(data);
          $("#result").append(
            `
              <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">Total Harga</label>
                  <div class="col-sm-12 col-md-10">
                  <span class="text-danger">*</span><small>Simpan untuk melanjutkan, refresh halaman ini jika melakukan perubahan data.</small>
                  <h5 class="font-weight-bold">Rp. ` +
              data +
              `</h5>
                  </div>
              </div>
          `
          );
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert("Harap isi data terlebih dahulu!");
        },
      });
    }
    // biaya tambahan tidak kosong
    else {
      $.ajax({
        url: base_url + "penjualan/cekHarga",
        data: {
          tujuan: tujuan,
          custom_harga: cusHarga,
          berat: berat,
          biaya_gudang: hargaGudang,
          admin_smu: adminSMU,
          admin_gudang: adminGudang,
          biaya_tambahan: biayaTambahan,
        },
        method: "POST",
        dataType: "JSON",
        success: function (data) {
          //
          console.log(data);
          $("#result").append(
            `
              <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">Total Harga</label>
                  <div class="col-sm-12 col-md-10">
                  <span class="text-danger">*</span><small>Simpan untuk melanjutkan, refresh halaman ini jika melakukan perubahan data.</small>
                      <h5 class="font-weight-bold">Rp. ` +
              data +
              `</h5>
                  </div>
              </div>
          `
          );
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert("Harap isi data terlebih dahulu!");
          // alert("Error: " + errorThrown);
        },
      });
    }
  });

  $(document).on("click", ".form-check-input", function () {
    if ($("input.check").prop("checked", true)) {
      $(".biayaTambahan").attr("readonly", false);
    }
  });

  $(document).on("dblclick", ".form-check-input", function () {
    if (this.checked) {
      $(this).prop("checked", false);
      $(".biayaTambahan").attr("readonly", true);
      $(".biayaTambahan").val("").html("");
    }
  });

  //
});

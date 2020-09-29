$(document).ready(function () {
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
                        <input type="radio" id="custom1" name="tipe" value="cash" class="custom-control-input" required>
                        <label class="custom-control-label" for="custom1">Harga Official (` +
            data.biaya +
            `)</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="custom2" name="tipe" value="debit" class="custom-control-input" required>
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
                          <input class="form-control" name="custom_harga" placeholder="Custom harga .." type="text" value="">
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
});

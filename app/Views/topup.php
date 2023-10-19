<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="mt-3 mx-3">
        <h6 class="text-grey"><strong>Silahkan Masukan</strong></h6>
        <h4><strong>Nominal Top up</strong></h4>
    </div>

    <div class="mt-5 mx-3">
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <input type="text" class="form-control" id="topup" placeholder="Masukan nominal Top up" readonly>
                    <button class="btn btn-secondary btn-block mt-3" id="button_topup" onclick="confirmTopUp()"><strong>Top Up</strong></button>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block" onclick="passingSaldo('10.000')">Rp10.000</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block" onclick="passingSaldo('20.000')">Rp20.000</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block" onclick="passingSaldo('50.000')">Rp50.000</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block mt-3" onclick="passingSaldo('100.000')">Rp100.000</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block mt-3" onclick="passingSaldo('250.000')">Rp250.000</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-block mt-3" onclick="passingSaldo('500.000')">Rp500.000</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function passingSaldo(saldo){
            $('#topup').val(saldo)
            $('#button_topup').removeClass('btn-secondary')
            $('#button_topup').addClass('btn-primary')
        }

        function confirmTopUp() {
            Swal.fire({
                html: `<h6>Anda yakin untuk Top Up sebesar <h6>
                    <h3 class="mt-3">Rp`+$('#topup').val()+`</h3>`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan Top Up',
                cancelButtonText: 'Batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    topUpProcess()
                }
            })
        }

        function topUpProcess() {

            $.ajax({
                url: "<?= getenv("API_URL") ?>/topup",
                type: "POST",
                headers: {"Authorization": "Bearer <?= $_COOKIE['sims_token'] ?>"},
                dataType: "json",
                data: {
                    "top_up_amount": $('#topup').val().replace('.', ''),
                },
                success: function(response) {
                    if(response.status == 108){
                        window.location.href = "<?= base_url('logout?expired=true') ?>"
                    }
                    confirmAlert(response.message, "Success", "success", "") 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    notifAlert("Error, TopUp Gagal", "error", "Oops...")
                }
            });
        }
    </script>

    <?= $this->endSection() ?>
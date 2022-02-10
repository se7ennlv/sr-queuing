<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>SRQ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='shortcut icon' type='files/x-icon' href='images/app-icon.ico' />

    <!-- css core -->
    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin-2.css?v=<?= date('His'); ?>" rel="stylesheet">
    <link href="assets/css/global-style.css?v=<?= date('His'); ?>" rel="stylesheet">

    <!-- js core -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/moment.js/moment.js"></script>
    <script src="assets/vendor/print-this/printThis.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

</head>

<body class="init-page">
    <div id="wrapper">
        <div class="container">
            <section class="text-center mt-1">
                <p>
                    <img src="files/logo2.png" class="img rounded mx-auto d-block" style="width: 240px; height: 170px;">
                </p>

                <h1 class="h1 mb-0 text-gray-800 font-weight-bold">SRQ</h1>
            </section>

            <div class="row">
                <div class="col-xl-6 col-md-6 offset-md-3 mb-4">
                    <div class="card border-top-primary shadow h-100" style="background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h1 class="display-1 text-center text-seccondary font-weight-bold" id="qNumber1">00</h1>

                                    <p class="mt-5">
                                        <button type="button" class="btn btn-warning btn-lg btn-block active" id="btnGetQ">
                                            <h1>กดเพื่อรับบัตรคิว</h1>
                                        </button>
                                    </p>
                                    <p class="mt-5">
                                        <hr class="sidebar-divider">
                                        <h4 class="now text-center text-primary font-weight-bold">20, Jul,2019 12:02:55 pm</h4>
                                        <h6 class="text-center text-primary font-weight-bold">ขอบคุณที่ใช้บริการ</h6>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-transparent">
                <div class="container my-auto">
                    <div class="copyright text-center text-secondary my-auto">
                        <span class="float-left">Version 1.0.2</span>
                        <span class="float-right">Developed by IT</span>
                    </div>
                </div>
            </footer>

        </div>


        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="printThis">
                        <table class="table table-borderless table-sm" style="max-width: 320px;">
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        <h1 class="font-weight-bold">SRQ</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h1 id="qNumber2" class="text-center" style="font-weight: 700 !important; font-size: 6rem;">00</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong class="now">3, Jan 2020 1:43:55 PM</strong><br>
                                        <strong>Thank you</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            GetRealTime()
            CheckQueue();
        });

        function GetRealTime() {
            var update;

            (update = function() {
                $('.now').text(moment().format('Do, MMM YY h:mm:ss A'));

                var checkTime = moment().format('HH:mm:ss');

                if (checkTime == '00:00:01') {
                    location.reload(true);
                }
            })();

            setInterval(update, 1000);
        }

        function CheckQueue() {
            $.ajax({
                type: 'GET',
                url: 'controllers/get_queue.php',
                dataType: 'JSON',
                success: function(data) {
                    $('#qNumber1').text(data);
                    $('#qNumber2').text(data);
                }
            });
        }

        $('#btnGetQ').on('click', function() {
            var params = {
                qNumber: $('#qNumber1').text()
            }

            $.ajax({
                type: 'POST',
                url: 'controllers/insert_tran.php',
                data: $.param(params),
                success: function(data) {
                    if (data.status === 'danger') {
                        Swal.fire('', 'Something went wrong, please contact IT', 'error');
                    } else {
                        BrowserPrint();
                    }
                }
            });

            return;
        });

        function BrowserPrint() {
            $('#printThis').printThis({
                importCSS: false,
                importStyle: false,
                loadCSS: [
                    "http://172.16.98.171/srq/assets/css/sb-admin-2.css",
                ],
                beforePrint: function() {
                    $('#btnGetQ').css('display', 'none');
                },
                afterPrint: function() {
                    $('#btnGetQ').css('display', 'block');
                    CheckQueue();
                }
            });
        }

        // function DirectPrint(qNumber) {
        //     $.get("print_queue.php?qNumber=" + qNumber);
        // }
    </script>

</body>

</html>
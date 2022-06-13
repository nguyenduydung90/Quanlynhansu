<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,500,600,700" />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Danh sách cán bộ</title>
    <style type="text/css">
        body {
            font: normal 12px/14px time, serif;
        }

        .header tr td {
            padding-top: 0px;
            padding-bottom: 5px;
        }

        .money tr td {
            text-align: right;
        }

        table,
        p {
            width: 98%;
            margin: auto;
        }

        table tr td:first-child {
            text-align: center;
        }

        td,
        th {
            padding: 5px;
        }

        p {
            padding: 5px;
        }

        span {
            text-transform: uppercase;
            font-weight: bold;
        }

        @media print {
            .in {
                display: none !important;
            }
        }

        #fixNav {
            /*background: #f7f7f7;*/
            background: #f9f9fa;
            width: 100%;
            height: 50px;
            display: block;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.5);
            /*Đổ bóng cho menu*/
            position: fixed;
            /*Cho menu cố định 1 vị trí với top và left*/
            top: 0;
            /*Nằm trên cùng*/
            left: 0;
            /*Nằm sát bên trái*/
            z-index: 100000;
            /*Hiển thị lớp trên cùng*/
        }

        #fixNav ul {
            margin: 0;
            padding: 0;
        }

        #fixNav ul li {
            list-style: none inside;
            width: auto;
            float: left;
            line-height: 35px;
            /*Cho text canh giữa menu*/
            color: #fff;
            padding: 0;
            margin-left: 10px;
            margin-top: 5px;
            position: relative;
        }

        #fixNav ul li a {
            text-transform: uppercase;
            white-space: nowrap;
            /*Cho chữ trong menu không bị wrap*/
            padding: 0 10px;
            color: #fff;
            display: block;
            font-size: 0.8em;
            text-decoration: none;
        }

    </style>

</head>



<body style="font:normal 11px Times, serif;">
    <div class="in">
        <nav id="fixNav">
            <ul>
                <li>
                    <button type="button" class="btn btn-success" border-radius:=border-radius: 30px=30px
                        onclick="window.print()">
                        <i class="fas fa-print"></i>&ensp;In dữ liệu
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-primary" onclick="ExDoc()">
                        <i class="far fa-file-word"></i>&ensp;Kết xuất file Doc
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-primary" onclick="exportTableToExcel()">
                        <i class="far fa-file-excel"></i>&ensp;Export Excel
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    <input type="hidden" id='title' $value={{$name_title}}>
    <div id="data" style="position: relative; margin-top: 70px; margin-bottom:50px; font-size:14px">
        <table class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
            style="margin:0 auto 25px; text-align: center;">
            <tr>
                <td style="text-align: left;width: 60%">

                </td>
                <td style="text-align: center;">

                </td>
            </tr>
            <tr>
                <td style="text-align: left;width: 60%">
                    <b>Đơn vị: </b>
                </td>
                <td style="text-align: center; font-style: italic">

                </td>
            </tr>
            <tr>
                <td style="text-align: left;width: 60%">
                    <b>Mã đơn vị SDNS: </b>
                </td>

                <td style="text-align: center; font-style: italic">

                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px;" name='title'>
                    {{ $name_title }}
                </td>
            </tr>
        </table>

    <table id="data_render" cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        {{-- <table class="money" cellspacing="0" cellpadding="0" border="1"
            style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;"> --}}
            <tr style="padding-left: 2px;padding-right: 2px">
                <th style="width: 3%;">S</br>T</br>T</th>
                <th style="width: 8%;">Họ và tên</th>
                <th style="width: 5%;">Chức vụ</th>
                <th style="width: 5%;">Khối</br>công tác</th>
                <th style="width: 8%;">Phòng ban</br>công tác</th>
                <th style="width: 15%;">Thường trú</th>
                <th style="width: 5%;">Ngày sinh</th>
                <th style="width: 3%;">Giới tính</th>
                <th style="width: 5%;">CMND/CCCD</th>
                <th style="width: 5%;">Số điện thoại</th>
                <th style="width: 8%;">Email</th>
                <th style="width: 5%;">Bằng cấp</th>
                <th style="width: 8%;">Trình độ </br> chuyên môn</th>
                <th style="width: 10%;">Trường đào tạo</th>
                <th style="width: 5%;">Năm</br>tốt nghiệp</th>
                <th style="width: 5%;">Ngày vào </br> công ty</th>
            </tr>

            <tr style="text-align: center">
                @for ($i = 1; $i <= 16; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
            @foreach ($model as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td style="text-align: left">{{ $item->hoten }}</td>
                    <td style="text-align: left">{{ $item->chucvu->tencv }}</td>
                    <td style="text-align: left">{{ $item->tenkhoi }}</td>

                    <td style="text-align: left">{{ $item->tenpb }}</td>

                    <td>{{ $item->thuongtru }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->ngaysinh)->format('d/m/Y') }}</td>
                    <td>{{ $item->gioitinh == 1 ? 'Nam' : 'Nữ' }}</td>
                    <td>{{ $item->cccd }}</td>
                    <td>{{ $item->sdt }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->bangcap }}</td>
                    <td>{{ $item->tdcm }}</td>
                    <td>{{ $item->truongdaotao }}</td>
                    <td>{{ $item->namtotnghiep }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->ngayvaoct)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    {{-- <table class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
        style="margin:20px auto; text-align: center;">

        <tr style="font-weight: bold">
            <td style="text-align: center;" width="50%">Người lập bảng</td>
            <td style="text-align: center;" width="50%">Hiệu Trưởng</td>
        </tr>
        <tr style="font-style: italic">
            <td style="text-align: center;" width="50%">(Ghi rõ họ tên)</td>
            <td style="text-align: center;" width="50%">(Ký tên, đóng dấu)</td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br></td>
        </tr>

        <tr>
            <td style="text-align: center;" width="50%"></td>
            <td style="text-align: center;" width="50%"></td>
        </tr>
    </table> --}}
    <script>
        function ExDoc() {
            var sourceHTML = document.getElementById("data").innerHTML;
            var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
            var fileDownload = document.createElement("a");
            document.body.appendChild(fileDownload);
            fileDownload.href = source;

            var title= $('#data').find('td[name=title]').text();
            var nameTitle=title.replace(/_/g, '');
                nameTitle=nameTitle.replace(/\s+/g, '') 
            fileDownload.download = nameTitle + '.doc';
            fileDownload.click();
            document.body.removeChild(fileDownload);
        }

        function exportTableToExcel() {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById('data');
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            var title= $('#data').find('td[name=title]').text();
            var nameTitle=title.replace(/_/g, '');
                nameTitle=nameTitle.replace(/\s+/g, '') 
            var filename = nameTitle + '.xls';


            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
</script>
</body>

</html>

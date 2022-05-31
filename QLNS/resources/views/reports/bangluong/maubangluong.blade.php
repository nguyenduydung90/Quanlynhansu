<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $pageTitle }}</title>
    <style type="text/css">
        body {
            font: normal 12px/14px time, serif;
        }

        .header tr td {
            padding-top: 0px;
            padding-bottom: 10px;
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
            padding: 10px;
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

    </style>
</head>

<body style="font:normal 12px Times, serif;">
    <div class="in" style="margin-right: 20px; text-align:right">
        <button type="submit" onclick="window.print()">In bảng lương</button>

    </div>
    <table class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
        style="margin:0 auto 25px; text-align: center;">
        <tr>
            <td style="text-align: left;width: 60%">
                <b>Đơn vị chủ quản: </b>
            </td>
            <td style="text-align: center;">
                <!--b>Mẫu số C02-X</b-->
            </td>
        </tr>
        <tr>
            <td style="text-align: left;width: 60%">
                <b>Đơn vị: </b>
            </td>
            <td style="text-align: center; font-style: italic">

            </td>
        </tr>
    </table>
    <p style="text-align: center; font-weight: bold; font-size: 20px;">BẢNG THANH TOÁN TIỀN LƯƠNG</p>
    <p style="text-align: center; font-style: italic">Tháng {{ $thongtin->thang }} năm {{ $thongtin->nam }}</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <tr style="padding-left: 2px;padding-right: 2px">
            <th style="width: 2%;padding-left: 2px;padding-right: 2px" rowspan="2">STT</th>
            <th style="width: 10%;padding-left: 2px;padding-right: 2px" rowspan="2">Họ và tên</th>
            {{-- <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Mã số</br>ngạch</br>bậc</th>
        <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Hệ số</br>lương</th>
        <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Hệ số</br>phụ</br>cấp</th>
        <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Cộng</br>hệ số</th>
        <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Mức lương</th> --}}
            {{-- <th colspan="2">Các khoản phụ</br>cấp khác</th> --}}
            <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Tổng lương</br>được hưởng</th>
            {{-- <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">BHXH trả</br>thay lương</th> --}}
            <th colspan="7">Các khoản phải khấu trừ</th>
            <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Thực nhận</th>
            <th style="width: 6%;padding-left: 2px;padding-right: 2px" rowspan="2">Ký nhận</th>
        </tr>

        <tr style="padding-left: 2px;padding-right: 2px">
            {{-- <th>Hệ số</th>
        <th>Số tiền</th> --}}

            <th>BHXH</th>
            <th>BHYT</th>
            <th>BHTN</th>
            <th>KPCĐ</th>
            <th>Tiền cơm</th>
            <th>Tiền phạt</th>
            <th>Cộng</th>
        </tr>

        <tr>
            @for ($i = 1; $i <= 12; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
        @foreach ($phongban as $item)
            <tr style="font-weight: bold;">
                <td></td>
                <td style="text-align: left;" colspan="34">{{ $item->tenpb }}</td>
            </tr>

            <?php $stt = 1; ?>
            @foreach ($data[$item->id] as $ct)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>{{ $ct->hoten }}</td>
                    <td>{{ number_format($ct->tongluong) }}</td>
                    <td>{{ number_format($ct->ptbhxh) }}</td>
                    <td>{{ number_format($ct->ptbhyt) }}</td>
                    <td>{{ number_format($ct->ptbhtn) }}</td>
                    <td>{{ number_format($ct->kpcd) }}</td>
                    <td>{{ number_format($ct->tiencom) }}</td>
                    <td>{{ number_format($ct->tienphat) }}</td>
                    <td></td>
                    <td>{{ number_format($ct->thucnhan) }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach
        <tr style="font-weight: bold; text-align: center">
            <td colspan="2">Tổng cộng</td>
            <td>{{ number_format($bangluong_ct->sum('tongluong')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('ptbhxh')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('ptbhyt')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('ptbhtn')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('kpcd')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('tiencom')) }}</td>
            <td>{{ number_format($bangluong_ct->sum('tienphat')) }}</td>
            <td></td>
            <td>{{ number_format($bangluong_ct->sum('thucnhan')) }}</td>
            <td></td>
        </tr>
    </table>

    <table class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
        style="margin:20px auto; text-align: center;">
        <tr>
            <td style="text-align: left;" width="50%"></td>
            <td style="text-align: center; font-style: italic" width="50%">........,Ngày......tháng.......năm..........
            </td>
        </tr>
        <tr style="font-weight: bold">
            <td style="text-align: center;" width="50%">Người lập bảng</td>
            <td style="text-align: center;" width="50%">Thủ trưởng đơn vị</td>
        </tr>
        <tr style="font-style: italic">
            <td style="text-align: center;" width="50%">(Ghi rõ họ tên)</td>
            <td style="text-align: center;" width="50%">((Ký tên, đóng dấu))</td>
        </tr>
        <tr>
            <td><br><br><br></td>
        </tr>

        <tr>
            <td style="text-align: center;" width="50%">{{ Auth()->user()->name }}</td>
            <td style="text-align: center;" width="50%"></td>
        </tr>
    </table>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Payroll System 2025</title>
    <style>
        table {
            border-collapse: collapse;
            width: 95%;
            margin: auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        td.name {
            text-align: left;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center;">Payroll per Cut-Off (Minute-Based Adjustments)</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Cut-Off Salary</th>
            <th>Total Adjustments</th>
            <th>Adjusted Gross</th>
            <th>SSS</th>
            <th>PhilHealth</th>
            <th>Pag-IBIG</th>
            <th>Income Tax</th>
            <th>Total Deduction</th>
            <th>Net Salary</th>
        </tr>
        @foreach($employees as $emp)
            <tr>
                <td class="name">{{ $emp['name'] }}</td>
                <td>{{ number_format($emp['cutoff_salary'], 2) }}</td>
                <td>{{ number_format($emp['total_adjustments'], 2) }}</td>
                <td>{{ number_format($emp['adjusted_gross'], 2) }}</td>
                <td>{{ number_format($emp['sss'], 2) }}</td>
                <td>{{ number_format($emp['philhealth'], 2) }}</td>
                <td>{{ number_format($emp['pagibig'], 2) }}</td>
                <td>{{ number_format($emp['income_tax'], 2) }}</td>
                <td>{{ number_format($emp['total_deduction'], 2) }}</td>
                <td>{{ number_format($emp['net_salary'], 2) }}</td>
            </tr>
        @endforeach
    </table>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
</body>

</html>
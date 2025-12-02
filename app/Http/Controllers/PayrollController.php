<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        foreach ($employees as &$emp) {
            $salary = $emp['salary'];

            // --- Cut-off salary ---
            $cutoff_salary = $salary / 2;

            // --- Daily, hourly, and minute rates ---
            $daily_rate = $salary / 22;      // 22 working days per month
            $hourly_rate = $daily_rate / 8;  // 8 hours per day
            $minute_rate = $hourly_rate / 60; // per minute

            // --- Compute deductions ---
            $late_deduction = $emp['late_minutes'] * $minute_rate;
            $undertime_deduction = $emp['undertime_minutes'] * $minute_rate;
            $halfday_deduction = $emp['half_days'] * $daily_rate * 0.5;
            $leave_deduction = $emp['leave_without_pay_days'] * $daily_rate;

            $total_adjustments = $late_deduction + $undertime_deduction + $halfday_deduction + $leave_deduction;

            // --- Adjusted gross for cut-off ---
            $adjusted_gross = $cutoff_salary - $total_adjustments;

            // --- Government Contributions (employee share per cut-off) ---
            $msc = $this->getSSSMSC($salary);
            $sss = round($msc * 0.05 / 2, 2); // per cut-off
            $philhealth = round(max($salary, 10000) * 0.025 / 2, 2);
            $pagibig = round(min($salary, 10000) * 0.02 / 2, 2);

            $total_contrib = $sss + $philhealth + $pagibig;

            // --- Taxable income per cut-off ---
            $taxable = $adjusted_gross - $total_contrib;

            // --- Income tax per cut-off ---
            $income_tax = round($this->computeBIRWithholding($taxable), 2);

            // --- Totals ---
            $emp['cutoff_salary'] = round($cutoff_salary, 2);
            $emp['total_adjustments'] = round($total_adjustments, 2);
            $emp['adjusted_gross'] = round($adjusted_gross, 2);
            $emp['sss'] = $sss;
            $emp['philhealth'] = $philhealth;
            $emp['pagibig'] = $pagibig;
            $emp['income_tax'] = $income_tax;
            $emp['total_deduction'] = round($total_contrib + $income_tax, 2);
            $emp['net_salary'] = round($adjusted_gross - $income_tax - $total_contrib, 2);
        }

        return view('payroll.index', compact('employees'));
    }

    /**
     * Given a gross monthly salary, returns the corresponding SSS Monthly Salary Credit (MSC),
     * using 2025 SSS schedule (min 5000, max 35000, increments of 500).
     */
    private function getSSSMSC($salary)
    {
        // Define the breakpoints for MSC
        $breakpoints = [
            5249.99 => 5000,
            5749.99 => 5500,
            6249.99 => 6000,
            6749.99 => 6500,
            7249.99 => 7000,
            7749.99 => 7500,
            8249.99 => 8000,
            8749.99 => 8500,
            9249.99 => 9000,
            9749.99 => 9500,
            10249.99 => 10000,
            10749.99 => 10500,
            11249.99 => 11000,
            11749.99 => 11500,
            12249.99 => 12000,
            12749.99 => 12500,
            13249.99 => 13000,
            13749.99 => 13500,
            14249.99 => 14000,
            14749.99 => 14500,
            15249.99 => 15000,
            15749.99 => 15500,
            16249.99 => 16000,
            16749.99 => 16500,
            17249.99 => 17000,
            17749.99 => 17500,
            18249.99 => 18000,
            18749.99 => 18500,
            19249.99 => 19000,
            19749.99 => 19500,
            20249.99 => 20000,
            20749.99 => 20500,
            21249.99 => 21000,
            21749.99 => 21500,
            22249.99 => 22000,
            22749.99 => 22500,
            23249.99 => 23000,
            23749.99 => 23500,
            24249.99 => 24000,
            24749.99 => 24500,
            25249.99 => 25000,
            25749.99 => 25500,
            26249.99 => 26000,
            26749.99 => 26500,
            27249.99 => 27000,
            27749.99 => 27500,
            28249.99 => 28000,
            28749.99 => 28500,
            29249.99 => 29000,
            29749.99 => 29500,
            30249.99 => 30000,
            30749.99 => 30500,
            31249.99 => 31000,
            31749.99 => 31500,
            32249.99 => 32000,
            32749.99 => 32500,
            33249.99 => 33000,
            33749.99 => 33500,
            34249.99 => 34000,
            34749.99 => 34500,
            // 35,000 is the maximum MSC
            INF => 35000,
        ];

        foreach ($breakpoints as $maxSalary => $msc) {
            if ($salary <= $maxSalary) {
                return $msc;
            }
        }
    }


    private function computeBIRWithholding($taxableIncome)
    {
        // Monthly withholding tax per TRAIN/BIR table
        if ($taxableIncome <= 20833) {
            return 0;
        } elseif ($taxableIncome <= 33332) {
            return ($taxableIncome - 20833) * 0.15;
        } elseif ($taxableIncome <= 66666) {
            return 1875 + ($taxableIncome - 33333) * 0.20;
        } elseif ($taxableIncome <= 166666) {
            return 8541.80 + ($taxableIncome - 66667) * 0.25;
        } elseif ($taxableIncome <= 666666) {
            return 33541.80 + ($taxableIncome - 166667) * 0.30;
        } else {
            return 183541.80 + ($taxableIncome - 666667) * 0.35;
        }
    }
}

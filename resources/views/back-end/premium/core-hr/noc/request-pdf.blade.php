<div class="container-fluid">
    {{-- {{ $noc_employee }} --}}
    <table class="table table-striped table-bordered">
        <tr>
            <td><img height="50" width="100px" src="{{ public_path($company_logo->company_logo) }}" /></td>
            <td>Date: {{ now()->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td>TO WHOM IT MAY CONCERN</td>
        </tr>
        <tr>
            <td colspan="2">
                This is to certify that <strong> {{ $noc_employee->nocemployee->first_name }}
                    {{ $noc_employee->nocemployee->last_name }} </strong>has been working under the
                management of
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{ $company_logo->company_name }} since {{ $noc_employee->nocemployee->joining_date }}. He has been
                designated as
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{ $noc_employee->nocemployee->userdesignation->designation_name }} under
                {{ $noc_employee->nocemployee->userdepartment->department_name }} at our client company Perfetti Van
                Melle
                (Bangladesh) Pvt. Ltd
            </td>
        </tr>
        <tr>
            <td colspan="2">
                We would like to inform you that {{ $noc_employee->nocemployee->first_name }}
                {{ $noc_employee->nocemployee->last_name }} Dr. Md. Faizul
                Kabir hails from House
            </td>
        </tr>
        <tr>
            <td colspan="2">
                no. 11, Road no. 5, Nikunja-2, Khilkhet, Dhaka-1229. He has taken personal
                leave from 24 th
            </td>
        </tr>
        <tr>
            <td colspan="2">
                April 2023 to 3 rd May 2023 to visit Thailand for the purpose of tourism
                during this period.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                To the best of our knowledge, he bears good moral character and is a
                sincere person. His
            </td>
        </tr>
        <tr>
            <td colspan="2">personal information is as follows:</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>: {{ $noc_employee->nocemployee->first_name }}
                {{ $noc_employee->nocemployee->last_name }}</td>
        </tr>
        <tr>
            <td>Job title</td>
            <td>: {{ $noc_employee->nocemployee->userdesignation->designation_name }}</td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td>: {{ $noc_employee->nocemployee->date_of_birth }}</td>
        </tr>
        <tr>
            <td>Passport No</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Date of Issue</td>
            <td>: {{ date('jS F Y', strtotime($noc_employee->date_of_issue)) }}</td>
        </tr>
        <tr>
            <td>Date of Expiry</td>
            <td>: {{ date('jS F Y', strtotime($noc_employee->date_of_expiry)) }}</td>
        </tr>
        <tr>
            <td>Place of Birth</td>
            <td>: {{ $noc_employee->nocemployee->emoloyeedetail->birth_place ?? '' }}</td>
        </tr>
        <tr>
            <td>Nationality</td>
            <td>: {{ $noc_employee->nocemployee->emoloyeedetail->userNationality->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Place of Issue</td>
            <td>: {{ $noc_employee->place_of_issue }}</td>
        </tr>
        <tr>
            <td colspan="2">
                All concerned are requested to cooperate {{ $noc_employee->nocemployee->first_name }}
                {{ $noc_employee->nocemployee->last_name }} accordingly.
            </td>
        </tr>
        <tr>
            <td>Regards, <br>
                <img height="50" width="100px"
                    src="{{ public_path($noc_employee->noctemplate->non_objection_certificate_signature) }}" />
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">{{ $noc_employee->noctemplate->signatory->first_name }} {{ $noc_employee->noctemplate->signatory->last_name }}</td>
        </tr>
        <tr>
            <td colspan="2">
                {{ $noc_employee->noctemplate->signatory->userdesignation->designation_name }},<br />{{ $company_logo->company_name }}.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                1 | P a g e | {{ $company_logo->company_name }}., {{ $company_logo->company_address }}, {{ $company_logo->company_city }}, {{ $company_logo->company_country }};
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Tel: {{ $company_logo->company_phone }};{{ $company_logo->company_web_address }} , email:
                {{ $company_logo->company_email }}
            </td>
        </tr>
        <tr>
            <td colspan="2">Classification: Internal</td>
        </tr>
    </table>
</div>

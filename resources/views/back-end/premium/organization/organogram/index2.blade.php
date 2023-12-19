@extends('back-end.premium.layout.premium-main')
<link href="https://fonts.googleapis.com/css?family=Gochi+Hand" rel="stylesheet">
<script src="{{ asset('org-asset/js/OrgChartBlack.js') }}"></script>
{{-- <script src="https://balkan.app/js/OrgChart.js"></script> --}}
<link rel="{{ asset('org-asset/css/style.css') }}">
@section('content')
    <section class="main-contant-section">
        <div id="tree"></div>
    </section>
    <script src="{{ asset('org-asset/js/script.js') }}"></script>
    <script type="text/javascript"></script>
@endsection

@extends('layouts.app')
@section('content')
<div id="gantt_here" style='width:100%; height:600px;'></div>
@endsection

@push('scripts')
<script type="text/javascript">
gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
gantt.config.order_branch = true;
gantt.config.order_branch_free = true;
 
gantt.init("gantt_here", new Date(2018,6,1), new Date(2018,7,1));
 
gantt.load("/api/data");
 
var dp = new gantt.dataProcessor("/api");
dp.init(gantt);
dp.setTransactionMode("REST");
</script>
@endpush
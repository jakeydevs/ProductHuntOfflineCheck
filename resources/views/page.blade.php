@extends('master')

@section('body')
<div id="app" class="h-screen w-screen overflow-hidden flex flex-row justify-between items-center">
  <div class="flex h-full w-1/2 justify-center items-center" style="background: #da552f">
    <div>
      <div id="calendar"></div>
      <button type="button" class="mt-10 flex w-full justify-center items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">
        Random
      </button>
    </div>
  </div>
  <div class="flex h-full overflow-y-scroll w-1/2 bg-gray-100">
    
    <hunts
    :data="{{ json_encode($hunts) }}"
    api="{{ route('test') }}"
    ></hunts>

  </div>
</div>
@endsection

@section('js')
<script>
  flatpickr("#calendar", {
    inline: true,
    defaultDate: "{{ $date }}",
    onChange: function(selectedDates, dateStr, instance) {
      window.location = "{{ route('index') }}?d="+ dateStr
    },
  });
</script>
@endsection
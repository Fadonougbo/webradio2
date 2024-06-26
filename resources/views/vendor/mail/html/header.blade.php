@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('images/rtulogo1.jpg')}}" class="logo" alt="RTU logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

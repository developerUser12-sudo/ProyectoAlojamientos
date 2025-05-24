@props(['url']) 
<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
      <img src="{{ config('app.frontend_url') }}/assets/img/logo.webp" alt="Logo">
    </a>
  </td>
</tr>
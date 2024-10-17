{{-- Blade template example --}}
{{-- This section checks if the 'name' and 'nameHtml' variables are set before displaying them. --}}
{{-- {{ $name }} will escape any HTML to prevent injection. --}}
{{-- {{ $nameHtml }} will also be escaped, so the HTML tag will be displayed as plain text. --}}
Hello, I'm a blade template
@isset($name)
    @isset($nameHtml)
        <div>The name is: {{ $name }}</div>
        <div>The name is: {{ $nameHtml }}</div>
    @endisset
@endisset

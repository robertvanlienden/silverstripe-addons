<h1>$Title</h1>

<% if $SlideShowImages %>
    <% loop $SlideShowImages %>
        $Title
        $Image
    <% end_loop %>
<% end_if %>

$Content
$Form

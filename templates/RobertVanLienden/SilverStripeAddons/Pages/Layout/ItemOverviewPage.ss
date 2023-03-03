<h1>$Title</h1>
$ElementalArea
$Content
$Form
<% if not $getItemPages('' , $AllItemDetailPages) %>
No items here!
<% end_if %>
<% loop $getItemPages('' , $AllItemDetailPages) %>
    <% if $Odd %>
        <div class="columns is-dekstop">
            <div class="column">
                <h3>$Title</h3>
                <p>
                    <% if $ProjectSummary %>
                        $ProjectSummary
                    <% else %>
                        $getShortContent($Content)
                    <% end_if %>
                </p>
                <a class="portfolio-detail-link title is-3" href="$URLSegment">
                    <a class="portfolio-detail-link title is-3" href="$URLSegment"> <% if $ButtonText %>$ButtonText<% else %>$Title<% end_if %> <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="column">
                <% if $OverviewImage %>
                    <a href="$URLSegment"><img src="$OverviewImage.FocusFill(600, 300).AbsoluteURL" alt="$OverviewImage.Title"></a>
                <% end_if %>
            </div>
        </div>
    <% else %>
        <div class="columns is-hidden-touch is-dekstop">
            <div class="column">
                <% if $OverviewImage %>
                    <a href="$URLSegment"><img src="$OverviewImage.FocusFill(600, 300).AbsoluteURL" alt="$OverviewImage.Title"></a>
                <% end_if %>
            </div>
            <div class="column">
                <h3>$Title</h3>
                <p>
                    <% if $ProjectSummary %>
                        $ProjectSummary
                    <% else %>
                        $Content
                    <% end_if %>
                </p>
                <a class="portfolio-detail-link title is-3" href="$URLSegment">
                    <i class="fa-solid fa-arrow-left"></i> <% if $ButtonText %>$ButtonText<% else %>$Title<% end_if %>
                </a>
            </div>
        </div>
        <div class="columns is-hidden-desktop is-dekstop">
            <div class="column">
                <h3>$Title</h3>
                <p>
                    <% if $ProjectSummary %>
                        $ProjectSummary
                    <% else %>
                        $getShortContent($Content)
                    <% end_if %>
                </p>
                <a class="portfolio-detail-link title is-3" href="$URLSegment">
                    <a class="portfolio-detail-link title is-3" href="$URLSegment"> <% if $ButtonText %>$ButtonText<% else %>$Title<% end_if %> <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="column">
                <% if $OverviewImage %>
                    <a href="$URLSegment"><img src="$OverviewImage.FocusFill(600, 300).AbsoluteURL" alt="$OverviewImage.Title"></a>
                <% end_if %>
            </div>
        </div>
    <% end_if %>
<% end_loop %>

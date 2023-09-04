<ul $AttributesHTML>
    <% loop $Options %>
        <li class="$Class">
            <input id="$ID" class="radio" name="$Name" type="radio" value="$Value"<% if $isChecked %> checked<% end_if %><% if $isDisabled %> disabled<% end_if %> />
            <label for="$ID" class="icon $Value  <% if not $Icon %>no-icon<% end_if %>">
                <% if $Icon %>
                    <i data-feather="$Icon"></i>
                <% else %>
                    <span class="title">$Title</span>
                <% end_if %>
            </label>
            <% if $Icon %><span class="title">$Title</span><% end_if %>
    <% end_loop %>
</ul>

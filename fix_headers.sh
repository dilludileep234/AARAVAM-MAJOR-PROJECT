#!/bin/bash
for i in resources/views/algorithm-list.blade.php resources/views/events.blade.php resources/views/cultural-list.blade.php resources/views/arts-list.blade.php resources/views/contact.blade.php resources/views/sports-list.blade.php resources/views/cultural.blade.php resources/views/elevate-list.blade.php resources/views/algorithm.blade.php resources/views/arts.blade.php resources/views/sports.blade.php resources/views/elevate.blade.php; do
    if [ -f "$i" ]; then
        sed -i -e '/<header/,/<\/header>/c\    @include("partials.header")' "$i"
    fi
done

# Changelog

### Release 1.3
1. Create Vue card component
2. Create timeline for displaying multiple cards
3. Create Twitter-specific cards
    - These make use of the generic card, but are used for rendering tweets
    - Parse tweet data for proper tweet display
4. Setup connection to Twitter API
5. Add support for displaying a single, specific tweet by ID
6. Add support for displaying single, newest tweet in timeline

### Release 1.2.1
1. Convert globally-registered components to locally-registered components
2. Rework event handling between button and menu
3. Make button event handler generic for reuse
4. Use root Vue instance in place of dedicated event dispatcher
5. Move Button and HeaderMenu components to their own files

### Release 1.2
1. Add border and text color transitions to buttons
2. Setup first Vue-based menu system

### Release 1.1
1. Fix issue causing `ERR_TOO_MANY_REDIRECTS`

The issue was basically an infinite loop of redirects back and forth between the home and Coming Soon pages. It was caused by flawed logic in the `MaintenanceMode::handle` method. This issue should now be resolved.

### Release 1.0
1. Move all currently-defined routes to default route group
2. Move remaining coming-soon and maintenance mode redirect logic to middlewares
3. Add catch-all route to ensure coming-soon and maintenance modes can't be circumvented
4. Add CHANGELOG link to README

### Release 0.4.1.1
1. Finally setup Changelog

### Release 0.4.1
1. Setup ComingSoon middleware
2. Setup MaintenanceMode middleware
3. Remove `if` statements that were supposed to check for the "Coming Soon" and "Maintenance" settings

### Release 0.4
1. Remove "Coming Soon" page view
2. Simplify routes
3. Disable 2 currently-unnecessary routes
4. Use environment var for enabling/disabling "Coming Soon" mode
5. Rework homepage
6. Update styles
7. Allow viewing splash pages on local dev when their related environment vars are set to false or unset

##### Notes
To clear up confusion about the "Coming Soon" changes above:

Early on, I was playing with the idea of a "Coming Soon" view for pages that were in the works. I decided later that showing a 404 page would be more normal; I wouldn't need to commit to having a specific page in this case, whereas showing a "Coming Soon" view feels more like a commitment.

The other "Coming Soon" mentioned above, however, is a splash page for the entire website.

### Release 0.3.1
1. Remove GitLab icon

### Release 0.3
1. Setup views for some HTTP errors
2. Add inline social icons
3. Add first hosted image file
4. Tweak homepage some more
5. Update general styles

### Release 0.2
1. Update website title
2. Use environment vars for Coming Soon and Maintenance splash pages
3. Finish initial work on header nav
4. Tweak homepage
5. Fix display of footer when page content is long
6. Begin working on error pages
7. Add base64-encoded favicon

### Release 0.1.1
1. Correct public-facing directory in Procfile

### Release 0.1
1. Setup first splash pages
2. Setup first routes
3. Remove a handful of default dependencies
4. First bit of work on menu items and general layout
5. Add Procfile

Most of this first release involves playing around with layout, routes, and Heroku-related settings. It contains more changes than necessary for the release, honestly. But I didn't worry about it since visitors would see a Coming Soon page anyway.

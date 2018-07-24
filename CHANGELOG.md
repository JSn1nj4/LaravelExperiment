# Changelog

### Release 1.2
- Add border and text color transitions to buttons
- Setup first Vue-based menu system

### Release 1.1
- Fix issue causing `ERR_TOO_MANY_REDIRECTS`

The issue was basically an infinite loop of redirects back and forth between the
home and Coming Soon pages. It was caused by flawed logic in the
`MaintenanceMode::handle` method. This issue should now be resolved.

### Release 1.0
- Move all currently-defined routes to default route group
- Move remaining coming-soon and maintenance mode redirect logic to middlewares
- Add catch-all route to ensure coming-soon and maintenance modes can't be
  circumvented
- Add CHANGELOG link to README

### Release 0.4.1.1
- Finally setup Changelog

### Release 0.4.1
- Setup ComingSoon middleware
- Setup MaintenanceMode middleware
- Remove `if` statements that were supposed to check for the "Coming Soon" and
  "Maintenance" settings

### Release 0.4
- Remove "Coming Soon" page view
- Simplify routes
- Disable 2 currently-unnecessary routes
- Use environment var for enabling/disabling "Coming Soon" mode
- Rework homepage
- Update styles
- Allow viewing splash pages on local dev when their related environment vars
  are set to false or unset

##### Notes
To clear up confusion about the "Coming Soon" changes above:

Early on, I was playing with the idea of a "Coming Soon" view for pages that
were in the works. I decided later that showing a 404 page would be more normal;
I wouldn't need to commit to having a specific page in this case, whereas
showing a "Coming Soon" view feels more like a commitment.

The other "Coming Soon" mentioned above, however, is a splash page for the
entire website.

### Release 0.3.1
- Remove GitLab icon

### Release 0.3
- Setup views for some HTTP errors
- Add inline social icons
- Add first hosted image file
- Tweak homepage some more
- Update general styles

### Release 0.2
- Update website title
- Use environment vars for Coming Soon and Maintenance splash pages
- Finish initial work on header nav
- Tweak homepage
- Fix display of footer when page content is long
- Begin working on error pages
- Add base64-encoded favicon

### Release 0.1.1
- Correct public-facing directory in Procfile

### Release 0.1
- Setup first splash pages
- Setup first routes
- Remove a handful of default dependencies
- First bit of work on menu items and general layout
- Add Procfile

Most of this first release involves playing around with layout, routes, and
Heroku-related settings. It contains more changes than necessary for the
release, honestly. But I didn't worry about it since visitors would see a
Coming Soon page anyway.

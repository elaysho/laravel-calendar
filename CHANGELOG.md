# CHANGELOG

## 2021-12-06

### Added
- Added project files to repository
- Added CHANGELOG.md
- Added condition on storing of event if only one event per date period is allowed
- Added date validation to fields from and to in Requests/StoreCalendarEvent
- Added calendar icon near app name on App.vue
- Added redirect to /vue/calendar

### Changed
- Changed store condition of event to if only one event per date period is allowed
- Changed store condition of event to default
- Changed next and prev icons
- Changed input date calendar icon to white

### Removed
- Removed drawer icon on App.vue
- Removed CalendarEventController from Controller/v1 folder
- Removed validation error on succesful store of event
# Development Notes

## TODO
- [x] Setup database
- [x] Create feedback form
- [x] Build admin login
- [x] Add dashboard
- [x] Make analytics page
- [x] Add CSV export
- [x] Test with more data (added seeder with 2000 entries!)
- [x] Deploy to DigitalOcean (see DEPLOYMENT.md)
- [ ] Add better error messages
- [ ] Maybe add email notifications?

## Known Issues
- Charts need internet for Chart.js CDN
- Need to add more validation on forms
- CSV export might be slow with lots of data
- ~~Analytics page was broken - fixed the query cloning issue (Dec 23)~~

## Team Notes
- Admin password is in .env file (default: admin123)
- Remember to change it before deployment
- Database uses MySQL/MariaDB
- Frontend uses Tailwind CSS

## Features Completed
1. Public feedback form with 3 steps
2. Admin panel with:
   - Login system (simple password)
   - Dashboard with metrics
   - Analytics with charts
   - Entries list with filters
   - Suggestions page
   - CSV export

## Testing
To test:
1. npm run dev
2. php artisan serve
3. Go to /feedback and submit test data
4. Login to /admin/login
5. Check if data shows up

## Resources Used
- Laravel docs
- Tailwind CSS docs
- Chart.js docs
- Stack Overflow (for MariaDB setup issues)

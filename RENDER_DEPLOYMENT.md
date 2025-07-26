# Render Deployment Guide

## Environment Variables Configuration

For your Render deployment to work correctly, you need to set the following environment variables in your Render dashboard:

### Required Environment Variables

1. **DB_HOST** - Your MySQL database host (e.g., `your-db-host.render.com`)
2. **DB_DATABASE** - Your database name (e.g., `event_management`)
3. **DB_USERNAME** - Your database username
4. **DB_PASSWORD** - Your database password

### How to Set Environment Variables in Render

1. Go to your Render dashboard
2. Select your web service
3. Go to the "Environment" tab
4. Add the following environment variables:
   ```
   DB_HOST=your-database-host.render.com
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

### Testing Your Configuration

After deploying, you can test your database connection by visiting:
```
https://your-app-name.onrender.com/test_db_connection.php
```

This will show you:
- Whether environment variables are properly set
- If the database connection is working
- Any error messages if something is wrong

### Common Issues and Solutions

1. **SQLSTATE[HY000] [2002] No such file or directory**
   - This means the DB_HOST is incorrect or the database is not accessible
   - Make sure you're using the correct host from your Render database service
   - Ensure your database service is running

2. **Environment variables not loading**
   - Make sure you've set them in the Render dashboard
   - Check that the variable names are exactly as shown above
   - Redeploy your application after setting environment variables

3. **Database connection timeout**
   - This might indicate network issues between your web service and database
   - Check if your database service is in the same region as your web service

### Database Setup

Make sure your database has the required tables. You can import your SQL files through:
- Render's database dashboard
- A database management tool like phpMyAdmin
- Direct SQL import

### Security Notes

- Never commit your `.env` file to version control
- Use strong passwords for your database
- Consider using Render's built-in database service for better security 
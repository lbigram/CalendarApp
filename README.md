# CalendarApp
About:

A web application, calendar application adaptation.

This is a web application for displaying a calendar with events. Events are listed on the calendar.
To view the events you have to click on the day which opens the events listing in a modal display.

The application uses ldap for authentication. There is an administration section for adding events to the calendar.
The calendar can be set to be filtered by various filters (this is custom set).

Dependencies:
- PHP Calendar
  Created by Corey Worrell (http://coreyworrell.com), with a little help from the Kohana Framework (http://kohanaframework.org) guys.
  Examples and documenation can be found here: http://coreyworrell.com/calendar/

Licence:
You can reuse freely!!!

Instructions for User:
1. Folder calapp contains the application files. Copy this folder into your web root.
2. Folder database contains the database schema to import. Import this database into your mysql instance.
3. To configure calapp, you must change calapp/application/config.php (Here you can set the LDAP server settings)
4. To configure the database settings, you must change calapp/application/database.php. You can create credentials to suit what is already existing.
5. Navigate to URL of application (Example: http://localhost/calapp)

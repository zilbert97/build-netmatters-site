# build-netmatters-site

## Database Schema
```
CREATE TABLE newsletter_signup (
  name TEXT NOT NULL,
  email TEXT UNIQUE,
  signed_up_at DATE NOT NULL
);

CREATE TABLE latest_news (
  title TEXT NOT NULL,
  summary TEXT NOT NULL,
  category TEXT DEFAULT "news",
  posted_by TEXT DEFAULT "Netmatters Ltd",
  posted_at DATE NOT NULL
);

CREATE TABLE contact (
  name TEXT NOT NULL,
  email_address TEXT NOT NULL,
  contact_number TEXT NOT NULL,
  message TEXT NOT NULL,
  submitted_at DATE NOT NULL
);
```

# ⭐ Am I Famous?

Am I Famous is a web application that allows users to check if their email address appears in a data breach. 

It is inspired by [Have I Been Pwned](https://haveibeenpwned.com/) service and was built for scratch as a learning project on backend PHP development.

## ⚠️ Disclaimer

This project was made for educational purposes only. I do not endorse or support sharing/having of personal data that does not belong to you.

## Setup

### Project setup

```bash
git clone https://github.com/edveikis/AmIFamous.git
```

```bash
cd AmIFamous/
```

```bash
composer install
```

```bash
docker compose up
```

### Database

#### Create tables(in this order)

* admins:

```sql
CREATE TABLE admins ( id int NOT NULL AUTO_INCREMENT, name varchar(255) NOT NULL, email varchar(255) NOT NULL, password varchar(255) NOT NULL, created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id) ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

* breaches:

```sql
CREATE TABLE breaches ( id int NOT NULL AUTO_INCREMENT, name varchar(255) DEFAULT NULL, file_name varchar(255) DEFAULT NULL, line_count int DEFAULT NULL, created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP, description longtext, uploader_id int DEFAULT NULL, PRIMARY KEY (id), KEY breaches_admins_FK (uploader_id), CONSTRAINT breaches_admins_FK FOREIGN KEY (uploader_id) REFERENCES admins (id) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

* breach_records:

```sql
CREATE TABLE breach_records ( id int NOT NULL AUTO_INCREMENT, breach_id int NOT NULL, email varchar(255) DEFAULT NULL, username varchar(255) DEFAULT NULL, password varchar(255) DEFAULT NULL, raw_data json DEFAULT NULL, created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id), KEY breach_records_breaches_FK (breach_id), CONSTRAINT breach_records_breaches_FK FOREIGN KEY (breach_id) REFERENCES breaches (id) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

NOTE: there is no registration form, admins have to be added manually. Password must be hashed using `password_hash($password, PASSWORD_DEFAULT)`

#### default config/db.php file

```php
<?php

return [
    'host' => 'db',
    'port' => '3306',
    'dbname' => 'amifamous',
    'username' => 'admin',
    'password' => 'password'
];
```

### Open it in a browser

* Open `http://localhost:8080/` in your browser

# 📜 License

This project is licensed under the GPL v3 [LICENSE](LICENSE).

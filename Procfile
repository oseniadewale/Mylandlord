web: |
  echo "===== PHP VERSION ====="
  php -v
  echo "===== ENABLED EXTENSIONS ====="
  php -m
  echo "===== USING CUSTOM INI ====="
  php -c .php.ini -i | grep pdo
  echo "===== STARTING SERVER ====="
  php -c .php.ini -S 0.0.0.0:8080 -t .


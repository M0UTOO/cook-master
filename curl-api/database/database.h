// DATABASE FUNCTIONS

int callback(void *NotUsed, int argc, char **argv, char **azColName);
void createTableIngredients(sqlite3 *db, char *sql, char *zErrMsg, int rc);
void createDatabase(sqlite3 *db, char *sql, char *zErrMsg, int rc);
void printTableIngredients(sqlite3 *db, char *sql, char *zErrMsg, int rc);
typedef struct Env Env;
struct Env {
    char *spoonacularAPIKey;
    char *otherAPIKey;
};

Env *readFile(char *filename);
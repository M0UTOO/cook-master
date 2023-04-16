#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "env.h"

Env *readFile(char *filename)
{
    Env *config = malloc(sizeof(Env));
    config->spoonacularAPIKey = malloc(33);
    config->otherAPIKey = malloc(30);

    config->spoonacularAPIKey = "Empty";
    config->otherAPIKey = "Empty";

    char line[256];
    char *key;
    const char delim[2] = "=";

    FILE *file = fopen(filename, "r");
    if (file == NULL)
    {
        printf("Error opening file %s\n", filename);
        exit(1);
    }

    while (fgets(line, sizeof(line), file))
    {
        if (line[0] == '#')
            continue;
        
        key = strtok(line, delim);
        while(key != NULL)
        {
            if(key[0] != '-')
            {
                if(config->spoonacularAPIKey == "Empty")
                {
                    int size = strlen(key);
                    config->spoonacularAPIKey = malloc(size);
                    memcpy(config->spoonacularAPIKey, key, size-1);
                    config->spoonacularAPIKey[size-1] = '\0';
                }
                else if(config->otherAPIKey == "Empty")
                {
                    int size = strlen(key);
                    config->otherAPIKey = malloc(size);
                    memcpy(config->otherAPIKey, key, size-1);
                    config->otherAPIKey[size-1] = '\0';
                }
            }
            key = strtok(NULL, delim);
        }
    }
    fclose(file);

    return config;
}
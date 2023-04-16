/*
PURPOSE: TRYING OUT THE CURL FUNCTIONS FROM A C PROGRAM
FROM THE NOUMOIN-SUN DEV TEAM

TO COMPILE : gcc *.c * /*.c -o main.exe -lcurl

STEPS:
Récupérer les variables d’environnements:
    On passe en argument au programme le endpoint de l’url d’appel à l’API et/ou des paramètres. 
Formater les variables d'environnements
    POST = json
    GET =  en paramètres : ingredients  	apples,flour,sugar 	A comma-separated list of ingredients that the recipes should contain.
Envoi de la requête
    Utilisation de curl
Retourner le texte récupérer
    Print le résultat de la requête


*/

#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <curl/curl.h>
#include "env/env.h"
#include "sqlite3.h"
#include "database/database.h"

typedef struct Arguments Arguments;
struct Arguments {
    char * endpoint;
    char * parameters;
};


//Managing arguments : waiting for client answers.
Arguments *getArguments(int arguments, char ** value){
    Arguments *parameters = NULL;
    if (arguments != 0){
        //printf("There are %d arguments, first one is : %s\n", arguments-1,value[1]);

        parameters =  malloc(sizeof(Arguments));

        // FILL IN THE STRUCT
        int size = strlen(value[1]);
        parameters->endpoint = malloc(size);
        memcpy(parameters->endpoint, value[1], size);
    }
    return parameters;
}

int main(int argc, char ** argv){

    //Get the arguments
    Arguments *parameters = getArguments(argc, argv);
    Env *config = readFile("env/.env");

    //DATABASE CALLS
    sqlite3 *db;
    char *zErrMsg = 0;
    int rc;
    char *sql;
    
    createTableIngredients(db, sql, zErrMsg, rc);

    CURL *curl;
    CURLcode res;
    
    curl = curl_easy_init();
    if(curl) {

        char apiKeyHeader[60] = "x-api-key:";
        strcat(apiKeyHeader, config->spoonacularAPIKey);

        /* add authentication header */
         struct curl_slist *headers=NULL;
         headers = curl_slist_append(headers, apiKeyHeader);
         curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
        
        /* set url*/
         curl_easy_setopt(curl, CURLOPT_URL, "https://api.spoonacular.com/food/ingredients/9266/information?amount=1");

        /* Perform the request, res will get the return code */
        res = curl_easy_perform(curl);
        curl_slist_free_all(headers); /* free the header.s */

        /* Check for errors */
        if(res != CURLE_OK)
        fprintf(stderr, "curl_easy_perform() failed: %s\n",
                curl_easy_strerror(res));
    
        /* always cleanup */
        curl_easy_cleanup(curl);
    }

    free(config->otherAPIKey);
    free(config->spoonacularAPIKey);
    free(config);

    return 0;

}
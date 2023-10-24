import axios from 'axios';
import { StatusCodes } from 'http-status-codes';

const config = {
    headers: {
        'Content-Type': "application/json",
    },
    timeout: 0
};

export const postData = async (endpoint: string, data: object): Promise<any> => {
    try {
        const response = await axios.post(endpoint, data, config);

        if (response.status === StatusCodes.OK || response.status === StatusCodes.CREATED) {
            return { response: response.data, error: null };
        } else {
            throw new Error(`Request failed with status ${response.status}`);
        }
    } catch (e: any) {
        let errorMessage: Record<string, any> = {};

        if (e.response) {
            // Utilisez le message d'erreur du serveur s'il est disponible
            if (e.response.data && e.response.data.message) {
                errorMessage.message = e.response.data.message;
            } else {
                switch (e.response.status) {
                    case StatusCodes.UNPROCESSABLE_ENTITY:
                        for (const key in e.response.data.errors) {
                            errorMessage[key] = e.response.data.errors[key];
                        }
                        break;
                    case StatusCodes.BAD_REQUEST:
                        errorMessage.message = "Mauvaise demande";
                        break;
                    case StatusCodes.UNAUTHORIZED:
                        errorMessage.message = "Non autorisé";
                        break;
                    case StatusCodes.FORBIDDEN:
                        errorMessage.message = "Accès refusé";
                        break;
                    case StatusCodes.NOT_FOUND:
                        errorMessage.message = "Ressource non trouvée";
                        break;
                    case StatusCodes.INTERNAL_SERVER_ERROR:
                        errorMessage.message = "Erreur interne du serveur";
                        break;
                    default:
                        errorMessage.message = "Une erreur s'est produite lors de la requête";
                }
            }
        } else if (e.request) {
            errorMessage.message = "Erreur de requête : La requête n'a pas pu être effectuée";
        } else {
            errorMessage.message = "Autre erreur : " + e.message;
        }

        return { response: null, error: errorMessage };
    }
};


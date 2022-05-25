/**
 * @author 2072030 - Kevin Laurence
 */

const dbVersion = "v1";
const genreCollection = "genre";
const bookCollection = "book";

class ApiService {
    static get dbVersion() {
        return dbVersion;
    }

    static get genreCollection() {
        return genreCollection;
    }
    
    static get bookCollection() {
        return bookCollection;
    }
}
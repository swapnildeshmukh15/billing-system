
import AppFunction from "../app/AppFunction";
import AxiosFunction from "./AxiosFunction";

export const urlGenerator = url => `${AppFunction.getBaseUrl()}/${url.split('/').filter(d => d).join('/')}`;

export const axiosGet = (url, data = null) => {
    return AxiosFunction.axiosGet(urlGenerator(url), data);
};

export const axiosPost = (url, data) => {
    return AxiosFunction.axiosPost({
        url: urlGenerator(url),
        data
    });
};

export const axiosPatch = (url, data) => {
    return AxiosFunction.axiosPatch({
        url: urlGenerator(url),
        data
    });
};

export const axiosDelete = (url) => {
    return AxiosFunction.axiosDelete(urlGenerator(url));
};

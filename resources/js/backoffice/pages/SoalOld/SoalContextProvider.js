import React, { createContext, useContext } from "react";

const SoalContext = createContext();

export const useSoalContext = () => {
	return useContext(SoalContext);
};

export const SoalContextProvider = ({ children, ...props }) => {
	return (
		<SoalContext.Provider {...props} >
			{children}
		</SoalContext.Provider>
	);
};

export default SoalContextProvider;

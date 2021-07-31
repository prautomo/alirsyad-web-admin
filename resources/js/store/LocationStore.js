import create from 'zustand'
const useLocationStore = create(set => ({
  hasError: true, 
  latitude: null,
   longitude: null, 
  setCurrentPosition: (position) => {
    set(state => ({ 
      latitude: position. latitude, 
      longitude: position.longitude, 
      hasError: position.error
    }))
  }
}))


export default useLocationStore;
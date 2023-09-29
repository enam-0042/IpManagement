import { Fragment, useEffect, useRef, useState } from "react";
import { Dialog, Transition } from "@headlessui/react";
import { send } from "../api/globalFetch";
import Loader from "../components/loader";

function Editip({ open, setOpen, selectedIp }) {
  
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({});
  const handleChange = (e) => {
    let name = e.target.name;
    let value = e.target.value;

    setFormData({ ...formData, [name]: value });
  };

  async function handleSubmit(event) {
    setLoading(true);
    event.preventDefault();
    const responseData = await send(`ip_lists/${selectedIp.id}`, { ...formData},'PUT');
    console.log(responseData);
    setLoading(false);
    setOpen(false);
  } 
  const cancelButtonRef = useRef(null);

  useEffect( ()=>{
    setFormData({
      ...selectedIp
    });
  },[selectedIp] )
  return (
    <Transition.Root show={open} as={Fragment}>

      <Dialog
        as="div"
        className="relative z-10"
        initialFocus={cancelButtonRef}
        onClose={setOpen}
      >
        <Transition.Child
          as={Fragment}
          enter="ease-out duration-300"
          enterFrom="opacity-0"
          enterTo="opacity-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </Transition.Child>

        <div className="fixed inset-0 z-10 overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <Transition.Child
              as={Fragment}
              enter="ease-out duration-300"
              enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enterTo="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-200"
              leaveFrom="opacity-100 translate-y-0 sm:scale-100"
              leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <Dialog.Panel className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 w-96">
                  <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <Dialog.Title
                      as="h3"
                      className="w-full text-base font-semibold leading-6 text-gray-900"
                    >
                     Edit IP
                    </Dialog.Title>
                    <div className="mt-2">
                      <div className="text-sm text-gray-500">
                        <form className="space-y-6" onSubmit={handleSubmit}>
                          <div>
                            <label
                              htmlFor="ip_address"
                              className="text-left block text-sm font-medium leading-6 text-gray-900"
                            >
                              IP address
                            </label>
                            <div className="mt-2">
                              <input
                                id="ip_address"
                                name="ip_address"
                                type="text"
                                required
                                value={formData.ip_address}
                                readOnly
                                className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                              />
                            </div>
                          </div>
                          <div>
                            <label
                              htmlFor="password"
                              className="text-left block text-sm font-medium leading-6 text-gray-900"
                            >
                              Label
                            </label>
                            <div className="mt-2">
                              <input
                                id="label"
                                name="label"
                                type="text"
                                value={formData.label}
                                required
                                onChange={handleChange}
                                className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                              />
                            </div>
                          </div>
                          <div>
                            <button
                              type="submit"
                              className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                              {loading && <Loader />}
                              Update IP
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </Dialog.Panel>
            </Transition.Child>
          </div>
        </div>
      </Dialog>
    </Transition.Root>
  );
}
export default Editip;
